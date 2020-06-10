 $sql = 'SELECT * FROM products';
        $products = DB::select($sql);
        return $products;