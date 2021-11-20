<?php

namespace App\Http\Controllers;

use App\Helper\Reply;
use App\Models\BaseModel;
use App\Models\BreakHoursSetting;
use App\Http\Requests\StoreBreakHours;
use Illuminate\Http\Request;

class BreakHoursSettingsController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('app.menu.breakhoursSettings');
        $this->activeSettingMenu = 'break_hours_settings';
        $this->middleware(function ($request, $next) {
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->breakhours = BreakHoursSetting::all();
        return view('breakhours-settings.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('breakhours-settings.create-breakhours-setting-modal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBreakHours $request)
    {
        $breakhour = new BreakHoursSetting();
        $breakhour->hours = $request->hours;
        $breakhour->break = $request->break;
        $breakhour->save();

        $breakhours = BreakHoursSetting::get();

        $options = BaseModel::options($breakhours, $breakhour, 'hours');

        return Reply::successWithData(__('messages.breakhoursAdded'), ['data' => $options, 'page_reload' => $request->page_reload]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->breakhours = BreakHoursSetting::find($id);
        return view('breakhours-settings.edit-breakhours-setting-modal', $this->data);
    }

    public function update(Request $request, $id)
    {
        $breakhour = BreakHoursSetting::findOrFail($id);
        $breakhour->hours = $request->hours;
        $breakhour->break = $request->break;
        $breakhour->save();

        return Reply::success(__('messages.breakhoursAdded'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BreakHoursSetting::destroy($id);
        return Reply::success(__('messages.breakhoursDeleted'));
    }
}
