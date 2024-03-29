<?php

namespace App\Http\Controllers;

use Exception;
use Barryvdh\DomPDF\PDF;
use App\Models\CrusadeTour;
use Illuminate\Http\Request;

class CrusadeTourController extends Controller
{
    //
    public function index()
    {
        $active = CrusadeTour::whereIsActive(true)->first();
        $crusadeTours = CrusadeTour::all();
        return view("Admin.crusade.tour", compact('active', 'crusadeTours'));
    }

    public function create()
    {
        $ct = null;
        $active = CrusadeTour::whereIsActive(true)->first();
        return view("Admin.crusade.add", compact('active', 'ct'));
    }

    public function store(Request $request)
    {
        $request->validate(["slug" => "required|unique:crusade_tours", "name" => "required", "banner_path" => "required"]);
        $ct=new CrusadeTour();
        $ct->store($request->only(["slug", "name"]), $request->file("banner_path"));
        return redirect()->route("admin.crusade.tour.index");
    }

    public function active($id)
    {
        $active = CrusadeTour::whereIsActive(true)->first();
        //set the current crusade active status to false
        if ($active) {
            $active->is_active = false;
            $active->save();
        }

        // set the crusadeTour  the user clicked to true
        try {
            $current  = CrusadeTour::findOrFail($id);
            $current->is_active = true;
            $current->save();
        } catch (Exception $e) {
        }
        return redirect()->route("admin.crusade.tour.index");
    }

    public function update($id, Request $request)
    {
        $request->validate(["slug" => "required", "name" => "required"]);

        try {
            $current  = CrusadeTour::findOrFail($id);
            $current->slug = $request->slug;
            $current->name = $request->name;

            if($request->hasFile("banner_path")){
                $current->deleteBanner();
                $current->banner_path = $current->storeFile($request->file("banner_path"));
            }
            $current->save();
        } catch (Exception $e) {
        }
        return redirect()->route("admin.crusade.tour.index");
    }

    public function delete($id)
    {
        try {
            $current  = CrusadeTour::findOrFail($id);
            if ($current->testimonies->count() == 0) {
                $current->deleteBanner();
                $current->delete();
            }
        } catch (Exception $e) {
        }
        return redirect()->route("admin.crusade.tour.index");
    }

    public function edit($id)
    {
        $ct = CrusadeTour::findOrFail($id);
        $active = CrusadeTour::whereIsActive(true)->first();
        return view("Admin.crusade.add", compact('ct', 'active'));
    }

    public function exportPdf($id)
    {
        $active = CrusadeTour::whereIsActive(true)->first();
        $crusadeTour = CrusadeTour::findOrFail($id);
        $pdf = app("dompdf.wrapper");
        $pdf->setOptions(['dpi' => 150, 'default_font' => 'helvetica', 'enable_php' => true, 'chroot' => public_path()]);
        $pdf->loadView("pdf.export", compact('crusadeTour', 'active'));
        return $pdf->stream('crusade-tour.pdf');
    }
}
