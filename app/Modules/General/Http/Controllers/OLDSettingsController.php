<?php

class SettingsController extends BaseController {

	/**
	 * Setting Repository
	 *
	 * @var Setting
	 */
	protected $setting;

	public function __construct(Setting $setting)
	{
		$this->setting = $setting;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$settings = Setting::all();


//dd($settings);
		return View::make('settings.index', compact('settings'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('settings.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

//dd($input);

Setting::set( $input['key'], $input['value'] );
			return Redirect::route('settings.index');

/*
		$validation = Validator::make($input, Setting::$rules);
		if ($validation->passes())
		{
$input['package'] = !empty($input['package']) ? $input['package'] : '';
$input['environment'] = !empty($input['environment']) ? $input['environment'] : '';
Cache::forever($input['group'] . '.' . $input['key'], $input['value']);
$this->dbconfig_setting->create($input);
			return Redirect::route('settings.index');
		}
		return Redirect::route('settings.create')
			->withInput()
			->withErrors($validation)
			->with('flash', 'There were validation errors.');
*/

	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $setting = $this->dbconfig_setting->findOrFail($id);

        return View::make('settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($key)
    {
/*
        $setting = $this->dbconfig_setting->find($id);

        if (is_null($setting))
        {
            return Redirect::route('settings.index');
        }

Cache::forget($setting['group'] . '.' . $setting['key'], $setting['value']);

        return View::make('settings.edit', compact('setting'));
*/
//		$setting = $this->setting->find($key);
		$setting = Setting::find($key);
//		$setting = Setting::get($key);

		if (is_null($setting))
		{
			return Redirect::route('settings.index');
		}
//dd($setting);
		return View::make('settings.edit', compact('setting'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
/*
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Dbconfig_setting::$rules);

        if ($validation->passes())
        {
            $setting = $this->dbconfig_setting->find($id);

$input['package'] = !empty($input['package']) ? $input['package'] : '';
$input['environment'] = !empty($input['environment']) ? $input['environment'] : '';

Cache::forever($input['group'] . '.' . $input['key'], $input['value']);

            $setting->update($input);

            return Redirect::route('settings.show', $id);
        }

        return Redirect::route('settings.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('flash', 'There were validation errors.');
*/
		$input = array_except(Input::all(), '_method');
//		$validation = Validator::make($input, Setting::$rules);

/*
		if ($validation->passes())
		{
//			$setting = Setting::get($id);
//			$setting->update($input);
			Setting::set( $input['key'], $input['value'] );

			return Redirect::route('settings.index', $id);
		}

		return Redirect::route('settings.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
*/
			Setting::set( $input['key'], $input['value'] );
			return Redirect::route('settings.index', $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

$dbconfig_setting = $this->dbconfig_setting->find($id);
Cache::forget($setting['group'] . '.' . $setting['key'], $setting['value']);

        $this->dbconfig_setting->find($id)->delete();

        return Redirect::route('settings.index');
    }

}
