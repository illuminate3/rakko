<?php namespace App\modules\ModuleManager\Http\Presenters;

use Laracasts\Presenter\Presenter;

use DB;

class Module extends Presenter {

//dd('loaded');

	/**
	 * Present the name
	 *
	 * @return string
	 */
	public function name()
	{
		return ucwords($this->entity->name);
	}


	/**
	 * Present the name
	 *
	 * @return string
	 */
	public function first_name()
	{
		return ucwords($this->entity->first_name);
	}

	/**
	 * Present the name
	 *
	 * @return string
	 */
	public function last_name()
	{
		return ucwords($this->entity->last_name);
	}
	/**
	 * Present the email
	 *
	 * @return string
	 */
	public function email()
	{
		return $this->entity->email;
	}


	/**
	 * Present the $departments
	 *
	 * @return string
	 */
	public function departments()
	{
		$return = '';
		$departments = $this->entity->departments;
//dd($departments);
		if (empty($departments))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($departments as $department)
			{
//			$return .= $department->present()->name() . ',&nbsp;';
			$return .= $department->name . ',&nbsp;';
			}
		}

		return trim($return, ',&nbsp;');
	}


	/**
	 * Present the grades
	 *
	 * @return string
	 */
	public function grades()
	{
		$return = '';
		$grades = $this->entity->grades;
//dd($grades);
		if (empty($grades))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($grades as $grade)
			{
//			$return .= $grade->present()->name() . ',&nbsp;';
			$return .= $grade->name . ',&nbsp;';
			}
		}

		return trim($return, ',&nbsp;');
	}


	/**
	 * Present the subjects
	 *
	 * @return string
	 */
	public function subjects()
	{
		$return = '';
		$subjects = $this->entity->subjects;
//dd($subjects);
		if (empty($subjects))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($subjects as $subject)
			{
//			$return .= $subject->present()->name() . ',&nbsp;';
			$return .= $subject->name . ',&nbsp;';
			}
		}

		return trim($return, ',&nbsp;');
	}


	/**
	 * Present the sites
	 *
	 * @return string
	 */
	public function sites()
	{
		$return = '';
		$sites = $this->entity->sites;
//dd($sites);

		if (empty($sites))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($sites as $site)
			{
//				$return .= $site->present()->name() . ',&nbsp;';
				$return .= $site->name . ',<br>';
			}
		}

		return trim($return, ',<br>');
	}

	/**
	 * Present the sites
	 *
	 * @return string
	 */
	public function sitesShow()
	{
		$return = '';
		$sites = $this->entity->sites;
//dd($sites);

		if (empty($sites))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($sites as $site)
			{
//				$return .= $site->present()->name() . ',&nbsp;';
				$return .= $site->name . ',&nbsp;';
			}
		}

		return trim($return, ',&nbsp;');
	}


	/**
	 * Present the jobtitles
	 *
	 * @return string
	 */
	public function jobtitles($id)
	{
/*
		$return = '';
		$jobtitles = $this->entity->job_titles;
//dd($positions);
		if (empty($jobtitles))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($jobtitles as $jobtitle)
			{
//			$return .= $position->present()->name() . ',&nbsp;';
			$return .= $jobtitle->name . ',&nbsp;';
			}
		}
*/

		$jobtitle = DB::table('job_titles')
			->where('id', '=', $id)
			->pluck('name');
		return $jobtitle;

//		return trim($return, ',&nbsp;');
	}

	/**
	 * Present the positions
	 *
	 * @return string
	 */
	public function positions($id)
	{
/*
		$return = '';
		$positions = $this->entity->positions;
//dd($positions);
		if (empty($positions))
		{
			$return = trans('lingos::general.none');
		} else {
			foreach ($positions as $position)
			{
//			$return .= $position->present()->name() . ',&nbsp;';
			$return .= $position->name . ',&nbsp;';
			}
		}
*/


		$position = DB::table('positions')
			->where('id', '=', $id)
			->pluck('name');
		return $position;

//		return trim($return, ',&nbsp;');
	}


}
