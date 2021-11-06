<?php

namespace App\Http\Controllers;

use App\Helper\Reply;
use App\Models\Code;
use App\Models\BaseModel;
use App\Http\Requests\CodeSetting\StoreCode;
use Illuminate\Http\Request;

class CodeSettingController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('app.menu.codeSettings');
        $this->activeSettingMenu = 'code_settings';
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
        $this->codes = Code::all();
        return view('code-settings.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('code-settings.create-code-setting-modal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCode $request)
    {
        $code = new Code();
        $code->number = $request->code_number;
        $code->title = $request->code_title;
        $code->money_1 = $request->code_money_1;
        $code->money_2 = $request->code_money_2;
        $code->slept = $request->code_slept;
        $code->active = 1;
        $code->save();

        $codes = Code::get();

        $options = BaseModel::options($codes, $code, 'number');

        return Reply::successWithData(__('messages.codeAdded'), ['data' => $options, 'page_reload' => $request->page_reload]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->code = Code::find($id);
        return view('code-settings.edit-code-setting-modal', $this->data);
    }

    public function update(Request $request, $id)
    {
        $code = Code::findOrFail($id);
        $code->number = $request->code_number;
        $code->title = $request->code_title;
        $code->money_1 = $request->code_money_1;
        $code->money_2 = $request->code_money_2;
        $code->slept = $request->code_slept;
        $code->active = $request->code_active;
        $code->save();

        return Reply::success(__('messages.codeAdded'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Code::destroy($id);
        return Reply::success(__('messages.codeDeleted'));
    }
}
