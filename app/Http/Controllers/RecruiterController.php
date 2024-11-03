<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\LlamaApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecruiterController extends Controller
{
    function dashboard(){
        $rec = User::distinct()->pluck('categories');
        $user = User::where('id','=',auth()->user()->id)->first();
        return view('recruiter.dashboard', ['categories' => $rec,
            'rec'=>$user]);
    }

    function requirements(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'category'=> 'required'

        ]);

        try {
            User::where('id', '=', auth()->user()->id)->update(['requirements' => $request->description]);
            return redirect()->route('recruiters.select', ['category' => $request->category]);
        }
        catch (\Exception $e) {
            return back()->withErrors(['description' => $e->getMessage()]);
        }
    }
    function select($category)
    {
        $category = strval($category);
        $rec = User::where('id', '=', auth()->user()->id)->first();
        $users = User::where('categories', '=', $category)->get();
        $parser = new \Smalot\PdfParser\Parser();
        $llama = new LlamaApiService();

        $resumes = "";
        $resume_id = 1;
        $resume_arr = [];

        // Step 1: Parse and build resumes text
        foreach ($users as $user) {
            // Retrieve and parse PDF content
            $pdfContent = Storage::disk('public')->get($user->resume);
            $pdf = $parser->parseContent($pdfContent);
            $text = $pdf->getText();

            // Append parsed resume text for llama input
            $resumes .= "\n#####\n Resume number: $resume_id. $text";
            $resume_arr[] = $user->resume;
            $resume_id++;
        }

        // Step 2: Use llama to analyze resumes based on recruiter requirements
        $path = 'prompts/pdfanalyser.txt';
        $sys_prompt = Storage::disk('public')->get($path);
        $suggest_res = $llama->llama(
            'Recruiter Requirement: ' . $rec->requirements . '\n' . $resumes,
            $sys_prompt
        )->getData(true);

        // Identify the top resume
        $top_resume_index = (int) $suggest_res - 1; // Adjust for array indexing
        $top_res = $users[$top_resume_index];

        // Step 3: Generate summaries for each resume
        $summaryPrompt = "You are an expert resume summarizer. Give me the short summary of the following resumes. Summary must be a maximum of 2 sentences. Keep the senetences as shorts as possible. Return each summary separated by ####. Return no other text.";
        $summaryResponse = $llama->llama($resumes, $summaryPrompt)->getData(true)['result']['response'];
//print_r($summaryResponse);
        // Split summaries based on the delimiter "####"
        $summaries = explode("####", $summaryResponse);

// Trim whitespace and remove empty entries from start and end
        $summaries = array_map('trim', $summaries); // Trim whitespace from each entry
        $summaries = array_filter($summaries, fn($value) => $value !== ''); // Remove empty entries

// Reindex the array to ensure indices are in sequential order
        $summaries = array_values($summaries);
//print_r($summaries);
        // Step 4: Append each summary to its corresponding user
        foreach ($users as $index => $user) {
            // Assign summary to each user object, or provide a default message if not available
//            echo $index;
//            print_r($user);
            $user->summary = $summaries[$index] ?? 'No summary available';
        }

        // Ensure the top resume also has its summary assigned
        $top_res->summary = $summaries[$top_resume_index] ?? 'No summary available';

        // Return view with users and top resume
        return view('recruiter.select', [
            'users' => $users,
            'top_resume' => $top_res,
        ]);
    }

}
