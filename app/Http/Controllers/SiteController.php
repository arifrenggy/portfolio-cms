<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Project;
use App\Models\Section;
use App\Models\SiteSetting;
use App\Models\Skill;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index', [
            'settings' => SiteSetting::current(),
            'menuItems' => MenuItem::visible()->get(),
            'sections' => Section::visible()->get(),
            'skills' => Skill::visible()->get(),
            'projects' => Project::visible()->get(),
        ]);
    }

    public function project(string $slug)
    {
        $project = Project::visible()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.project', [
            'settings' => SiteSetting::current(),
            'menuItems' => MenuItem::visible()->get(),
            'project' => $project,
        ]);
    }
}
