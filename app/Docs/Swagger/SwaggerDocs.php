<?php

namespace App\Docs\Swagger;

/**
 * @OA\Info(
 *     title="Multi-Warehouse Inventory API",
 *     version="1.0.0"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class SwaggerDocs
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function loginExample() {}

    /**
     * @OA\Get(
     *     path="/api/inventory/global-view",
     *     tags={"Inventory"},
     *     summary="Global inventory view",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function globalInventoryView() {}

    /**
     * @OA\Post(
     *     path="/api/inventory-transfer",
     *     tags={"Inventory"},
     *     summary="Transfer product between warehouses",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="product_id", type="integer"),
     *             @OA\Property(property="from_warehouse_id", type="integer"),
     *             @OA\Property(property="to_warehouse_id", type="integer"),
     *             @OA\Property(property="quantity", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Transfer complete")
     * )
     */
    public function transferInventory() {}

    /**
     * @OA\Get(
     *     path="/api/reports/low-stock",
     *     tags={"Reports"},
     *     summary="Daily low stock report",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Low stock items")
     * )
     */
    public function lowStockReport() {}

    /**
     * @OA\Get(path="/api/countries", tags={"Countries"}, summary="List countries", security={{"bearerAuth":{}}}, @OA\Response(response=200, description="OK"))
     * @OA\Post(path="/api/countries", tags={"Countries"}, summary="Create country", security={{"bearerAuth":{}}}, @OA\RequestBody(@OA\JsonContent(@OA\Property(property="name", type="string"))), @OA\Response(response=201, description="Created"))
     */
    public function countryEndpoints() {}

    /**
     * @OA\Get(path="/api/warehouses", tags={"Warehouses"}, summary="List warehouses", security={{"bearerAuth":{}}}, @OA\Response(response=200, description="OK"))
     * @OA\Post(path="/api/warehouses", tags={"Warehouses"}, summary="Create warehouse", security={{"bearerAuth":{}}}, @OA\RequestBody(@OA\JsonContent(@OA\Property(property="name", type="string"))), @OA\Response(response=201, description="Created"))
     */
    public function warehouseEndpoints() {}

    /**
     * @OA\Get(path="/api/products", tags={"Products"}, summary="List products", security={{"bearerAuth":{}}}, @OA\Response(response=200, description="OK"))
     * @OA\Post(path="/api/products", tags={"Products"}, summary="Create product", security={{"bearerAuth":{}}}, @OA\RequestBody(@OA\JsonContent(@OA\Property(property="name", type="string"))), @OA\Response(response=201, description="Created"))
     */
    public function productEndpoints() {}

    /**
     * @OA\Get(path="/api/suppliers", tags={"Suppliers"}, summary="List suppliers", security={{"bearerAuth":{}}}, @OA\Response(response=200, description="OK"))
     * @OA\Post(path="/api/suppliers", tags={"Suppliers"}, summary="Create supplier", security={{"bearerAuth":{}}}, @OA\RequestBody(@OA\JsonContent(@OA\Property(property="name", type="string"))), @OA\Response(response=201, description="Created"))
     */
    public function supplierEndpoints() {}

    /**
     * @OA\Post(
     *     path="/api/inventory-transactions",
     *     tags={"Transactions"},
     *     summary="Create inventory transaction",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(@OA\JsonContent(@OA\Property(property="type", type="string"), @OA\Property(property="quantity", type="integer"))),
     *     @OA\Response(response=200, description="Transaction complete")
     * )
     */
    public function inventoryTransaction() {}

    /**
     * @OA\Get(
     *     path="/api/inventory/report",
     *     summary="Get inventory transactions report",
     *     tags={"Inventory"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="from",
     *         in="query",
     *         description="Start date (YYYY-MM-DD)",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="to",
     *         in="query",
     *         description="End date (YYYY-MM-DD)",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="warehouse_id",
     *         in="query",
     *         description="Warehouse ID",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="product_id",
     *         in="query",
     *         description="Product ID",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Transaction type (in or out)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"in", "out"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="total", type="integer", example=5),
     *             @OA\Property(property="total_in", type="integer", example=20),
     *             @OA\Property(property="total_out", type="integer", example=10),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="date", type="string", format="date"),
     *                     @OA\Property(property="product", type="string"),
     *                     @OA\Property(property="warehouse", type="string"),
     *                     @OA\Property(property="type", type="string", enum={"in", "out"}),
     *                     @OA\Property(property="quantity", type="integer")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function inventoryReport() {}
}
