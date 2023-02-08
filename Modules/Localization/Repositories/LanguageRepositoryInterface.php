<?php

namespace Modules\Localization\Repositories;

interface LanguageRepositoryInterface
{
    public function all();

    public function serachBased($search_keyword);

    public function create(array $data);

    public function find($id);

    public function update(array $data, $id);

    public function delete($id);

    public function findByCode($code);
}
