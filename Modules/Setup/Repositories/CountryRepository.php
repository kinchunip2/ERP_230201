<?php

namespace Modules\Setup\Repositories;

use Modules\Setup\Entities\Country;
use Auth;
use Modules\Setup\Repositories\CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{
    public function all()
    {
        return Country::latest()->get();
    }

    public function serachBased($search_keyword)
    {
        return Country::whereLike(['name'], $search_keyword)->latest()->get();
    }
    public function create(array $data)
    {
        Country::create($data);
    }

    public function find($id)
    {
        return Country::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        return Country::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        $country = Country::findOrFail($id);
        
        return $country->delete();
    }
}
