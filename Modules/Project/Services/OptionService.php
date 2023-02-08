<?php
namespace Modules\Project\Services;
use Modules\Project\Repositories\FieldOptionRepository;
use Auth;

class OptionService{

	public $repo;

	public function __construct(
        FieldOptionRepository $repo
    )
	{
		$this->repo = $repo;

	}
	
    public function findOrFail($option_id)
    {
        return $this->repo->findOrFail($option_id);
    }

}
