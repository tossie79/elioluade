<?php

namespace App;

class Cart {

    public $items = null; // group of items[group of products]
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart) {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id) {
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item
        ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] ++;
        $storedItem['price'] = ($item->price) * ($storedItem['qty']);

        $this->items[$id] = $storedItem;

        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    public function stringifyCart() {
        
        $contents = null;
        if ($this->items) {
            $content = "";
            foreach ($this->items as $item) {
                $cartItem = $item['item'];
                $content .= $cartItem->name . ',' . $item['qty'].'; ';
            }
//            dd($content);
            $contents = json_encode($content);
        }
        return $contents;
    }

}
