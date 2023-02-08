<?php

namespace Modules\Purchase\Repositories;

use Modules\Purchase\Entities\CNF;
use Modules\Purchase\Entities\ProductItemDetail;
use Modules\Purchase\Entities\PurchaseOrder;

class CNFRepository implements CNFRepositoryInterface
{
    public function all()
    {
        return CNF::latest()->get();
    }

    public function create(array $data)
    {

        $cnf = new CNF();
        $cnf->fill($data)->save();
    }

    public function find($id)
    {
        return CNF::findOrFail($id);
    }

    public function update(array $data, $id)
    {

        $cnf = CNF::findOrFail($id);
        $cnf->update($data);
    }

    public function delete($id)
    {
        return CNF::destroy($id);
    }
}
