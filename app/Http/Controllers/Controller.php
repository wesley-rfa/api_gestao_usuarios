<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository;
use ReflectionClass;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $repository;
    private $class;

    public function __construct(BaseRepository $repository, String $class)
    {
        $this->repository = $repository;
        $reflectionClass = new ReflectionClass($class);
        $this->class = $reflectionClass->getShortName();
    }

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $pagination = $request->query('pagination');
        $order = $request->query('order');
        try {
            $result = $this->repository->getAll($filter, $pagination, $order);
            return $result;
        } catch (ModelNotFoundException $e) {
            Log::channel('controllers')->warning(
                $this->class . ' - Not Found error on index',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            $error['exceptionMesage'] = $e->getMessage();
        } catch (Exception $e) {
            Log::channel('controllers')->warning(
                $this->class . ' - Undefined error on index',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            $error['exceptionMesage'] = $e->getMessage();
        }
    }

    public function show(Request $request, $id = null)
    {
        try {
            return $this->repository->get($id);
        } catch (ModelNotFoundException $e) {
            Log::channel('controllers')->warning(
                $this->class . ' - Not Found error on show',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            $error['exceptionMesage'] = $e->getMessage();
        } catch (Exception $e) {
            Log::channel('controllers')->warning(
                $this->class . ' - Undefined error on show',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            $error['exceptionMesage'] = $e->getMessage();
        }
    }

    /**
     * Destroy method
     * @param Request $request
     * @param mixed $id
     * @return mixed
     * @throws BindingResolutionException
     */
    public function destroy(Request $request, $id = null)
    {
        try {
            $object = $this->repository->get($id);
            $this->repository->delete($id);
        } catch (ModelNotFoundException $e) {
            Log::channel('controllers')->warning(
                $this->class . ' - Not Found error on destroy',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            $error['exceptionMesage'] = $e->getMessage();
        } catch (Exception $e) {
            Log::channel('controllers')->warning(
                $this->class . ' - Undefined error on destroy',
                [
                    'messageError' => $e->getMessage(),
                    'codeError' => $e->getCode(),
                    'lineError' => $e->getLine(),
                    'fileError' => $e->getFile()
                ]
            );
            $error['exceptionCode'] = $e->getCode();
            $error['exceptionMesage'] = $e->getMessage();
        }

        return $object;
    }
}
