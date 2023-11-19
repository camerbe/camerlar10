<?php

namespace App\Repositories;

use App\Models\Publicite;
use App\Models\Rubrique;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
class PubliciteRepository extends BaseRepository
{
    public function __construct(Publicite $publicite)
    {
        $this->model=$publicite;
    }

    public function findById($id)
    {
        return parent::findById($id); // TODO: Change the autogenerated stub
    }

    public function delete($id)
    {
        return parent::delete($id); // TODO: Change the autogenerated stub
    }

    public function update(array $input, $id)
    {

        $input["datefin"]=Carbon::parse($input["datefin"])->format('Y-m-d');
        return parent::update($input, $id); // TODO: Change the autogenerated stub
    }

    public function create(array $input)
    {
        $input["datefin"]=Carbon::parse($input["datefin"])->format('Y-m-d');
        $data= parent::create($input); // TODO: Change the autogenerated stub
        return parent::findById($data->id);
    }
    public function findAll(){
        if($publicite=Cache::get('publicite-list')){
            return $publicite;
        }
        $publicite=Publicite::where([
            ['datefin', '>=', Carbon::parse(Carbon::now())->format('Y-m-d')],
        ])->orderBy('datefin','desc')->paginate();
        Cache::set('publicite-list',$publicite,Carbon::now()->addMinute(60));
        return $publicite;
    }

}