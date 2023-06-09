<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseRepository
{
    /** @var Model Base model*/
    private $baseClass;
    /** @var String Base model class name*/
    private $className;

    public function __construct(Model $baseClass)
    {
        $this->baseClass = new $baseClass;
        $this->className = get_class($this->baseClass);
    }

    /**
     * This method will return all the data from table airlines
     */
    public function getAll($filter = null, $pagination = null, $order = null, $fields = null)
    {
        dd($this->baseClass::all());
        if ($pagination) {
            return $this->baseClass::paginate($pagination);
        } else {
            return $this->baseClass::all();
        }
    }

    /**
     * This method will return paginates results queried by filters
     */
    public function get($id)
    {
        try {
            return $this->baseClass::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Log::channel('repositories')->warning(
                $this->baseClass . ' - ModelNotFoundException on get',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            throw new ModelNotFoundException($e->getMessage(), 404);
        } catch (Exception $e) {
            Log::channel('repositories')->warning(
                $this->baseClass . ' - Exception on get',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            throw new Exception($e->getMessage(), 500);
        }
    }

    /**
     * This method will insert new registers in data base
     */
    public function create($data)
    {
        DB::beginTransaction();
        try {
            $newData = camelCaseToSnakeCase($data);

            $model = $this->baseClass::create($newData);

            DB::commit();
            return $model;
        } catch (Exception $e) {
            Log::channel('repositories')->warning(
                $this->baseClass . ' - Exception on create',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            DB::rollBack();
            throw new Exception($e->getMessage(), 500);
        }
    }

    /**
     * This method will update a register in data base
     */
    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $newData = camelCaseToSnakeCase($data);

            $model = $this->baseClass::findOrfail($id)
                ->update($newData);

            DB::commit();

            if ($model) {
                return $this->get($id);
            } else {
                return false;
            }
        } catch (ModelNotFoundException $e) {
            Log::channel('repositories')->warning(
                $this->baseClass . ' - ModelNotFoundException on update',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            DB::rollBack();
            throw new ModelNotFoundException($e->getMessage(), 404);
        } catch (Exception $e) {
            Log::channel('repositories')->warning(
                $this->baseClass . ' - Exception on update',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            DB::rollBack();
            throw new Exception($e->getMessage(), 500);
        }
    }

    /**
     * This method will delete a register in data base
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->baseClass::findOrFail($id)->delete();
            DB::commit();
            return true;
        } catch (ModelNotFoundException $e) {
            Log::channel('repositories')->warning(
                $this->baseClass . ' - ModelNotFoundException on delete',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            DB::rollBack();
            throw new ModelNotFoundException($e->getMessage(), 404);
        } catch (Exception $e) {
            Log::channel('repositories')->warning(
                $this->baseClass . ' - Exception on delete',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            DB::rollBack();
            throw new Exception($e->getMessage(), 500);
        }
    }
}
