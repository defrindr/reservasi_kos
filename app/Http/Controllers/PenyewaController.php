<?php

namespace App\Http\Controllers;

use App\Http\Services\PenyewaService;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function __construct(protected PenyewaService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = $this->service->fetch(
            request('search', ''),
            request('orderBy', 'id'),
            request('orderDirection', 'ASC'),
            request('limit', 10),
            request('paginate', true)
        );

        return view('penyewa.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penyewa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $success = $this->service->store($request->all());
            if (!$success) {
                return redirect()->back()->with('error', 'Failed to create data');
            }
            return redirect()->route('penyewa.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = $this->service->show($id);
        $user = $page->user;
        return view('penyewa.edit', compact('page', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $page = $this->service->show($id);
            $success = $this->service->update($request->all(), $page->id);
            if (!$success) {
                return redirect()->back()->with('error', 'Failed to update data');
            }
            return redirect()->route('penyewa.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $page = $this->service->show($id);
            $success = $this->service->destroy($page->id);
            if (!$success) {
                return redirect()->back()->with('error', 'Failed to delete data');
            }
            return redirect()->route('penyewa.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
