<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\Pedido;

class PedidoRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Pedido());
    }

    public function create($newOrder)
    {
        DB::beginTransaction();
        try {
            $newOrder = $this->orderToSnakeCase($newOrder);
            $order = Pedido::create($newOrder);
            $order->itens()->createMany($newOrder['itens']);

            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), 500);
        }
    }

    private function orderToSnakeCase($newOrder)
    {
        $newOrder = camelCaseToSnakeCase($newOrder);

        if (isset($newOrder['itens'])) {
            foreach ($newOrder['itens'] as $key => $value) {
                $newOrder['itens'][$key] = camelCaseToSnakeCase($value);
            }
        }

        return $newOrder;
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $request = $this->orderToSnakeCase($request);
            $order = Pedido::findOrfail($id);
            $order->update($request);
            $order = $this->updateItens($request, $order);

            DB::commit();
            return $order->refresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), 500);
        }
    }

    private function updateItens($request, Pedido $order)
    {
        if (isset($request['itens'])) {
            $order->itens()->delete();
            foreach ($request['itens'] as $item) {
                if (isset($item['id'])) {
                    $order->itens()->withTrashed()->find($item['id'])->restore();
                }
                $id = $item['id'] ?? null;
                $order->itens()->updateOrCreate(["id" => $id], $item);
            }
        }

        return $order;
    }
}
