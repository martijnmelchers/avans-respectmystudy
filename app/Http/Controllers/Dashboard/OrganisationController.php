<?php

namespace App\Http\Controllers\Dashboard;

use App\Location;
use App\Organisation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;

class OrganisationController extends Controller
{
    public function Organisations()
    {
        $organisations = null;

        $organisation_name = "";
        if (isset($_GET['name'])) $organisation_name = $_GET['name'];

        $organisations = Organisation::where("name", "like", "%$organisation_name%")->get();

        return view('dashboard/organisations/list', ['organisations' => $organisations, 'search' => ['name' => $organisation_name]]);
    }

    public function Organisation($id)
    {
        return view('dashboard/organisations/organisation', ['organisation' => Organisation::where('id', $id)->first()]);
    }

    public function Edit($id)
    {
        return view('dashboard/organisations/edit', ['organisation' => Organisation::where('id', $id)->first()]);
    }

    public function EditPost($id, Request $request)
    {
        $organisation = Organisation::findOrFail($id);
        $organisation->fill($request->all());

        if($request->hasFile('organisation_image')){
            $organisation->organisation_image = OrganisationController::SaveFeatured($request);
        }

        $organisation->save();

        return redirect()->route('dashboard-organisation', ["id" => $id]);
    }

    private static function SaveFeatured(Request $request){
        return $request->file('organisation_image')->store('public');
    }
}
