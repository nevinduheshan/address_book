<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // List all projects
    public function index()
    {
        $projects = Project::with('customers')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    // Show the create project form
    public function create()
    {
        $customers = Customer::all();
        return view('projects.create', compact('customers'));
    }

    // Store a new project
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'customers' => 'required|array',
        ]);

        $project = Project::create($validated);
        $project->customers()->sync($validated['customers']);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    // Show the edit form for a project
    public function edit(Project $project)
    {
        $customers = Customer::all();
        return view('projects.edit', compact('project', 'customers'));
    }

    // Update an existing project
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'customers' => 'required|array',
        ]);

        $project->update($validated);
        $project->customers()->sync($validated['customers']);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    // Delete a project
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
