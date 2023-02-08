<?php
namespace Modules\Setting\Repositories;

interface PdfFontRepositoryInterface
{
    public function index();

    public function create(array $data);

    public function statusUpdate(array $data);
    
    public function delete($id);

 
}