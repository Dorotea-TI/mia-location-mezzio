<?php

namespace Mia\Location\Handler\Address;
/**
 * Description of ListHandler
 * 
 * @OA\Post(
 *     path="/mia_user_address/list",
 *     summary="MiaUserAddress List",
 *     tags={"MiaUserAddress"},
 *     @OA\RequestBody(
 *         description="Object query",
 *         required=false,
 *         @OA\MediaType(
 *             mediaType="application/json",                 
 *             @OA\Schema(
 *                  @OA\Property(
 *                      property="page",
 *                      type="integer",
 *                      description="Number of pace",
 *                      example="1"
 *                  ),
 *                  @OA\Property(
 *                      property="where",
 *                      type="string",
 *                      description="Wheres | Searchs",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="withs",
 *                      type="array",
 *                      description="Array of strings",
 *                      example="[]"
 *                  ),
 *                  @OA\Property(
 *                      property="search",
 *                      type="string",
 *                      description="String of search",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="ord",
 *                      type="string",
 *                      description="Ord",
 *                      example=""
 *                  ),
 *                  @OA\Property(
 *                      property="asc",
 *                      type="integer",
 *                      description="Integer",
 *                      example="1"
 *                  ),
 *                  @OA\Property(
 *                      property="limit",
 *                      type="integer",
 *                      description="Limit",
 *                      example="50"
 *                  )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Property(ref="#/components/schemas/MiaJsonResponse"),
 *                  @OA\Property(
 *                      property="response",
 *                      type="array",
 *                      @OA\Items(type="object", ref="#/components/schemas/MiaUserAddress")
 *                  )
 *              }
 *          )
 *     ),
 *     security={
 *         {"bearerAuth": {}}
 *     },
 * )
 *
 * @author matiascamiletti
 */
class ListAdminHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        // Get Current User
        $user = $this->getUser($request);
        // Configurar query
        $configure = new \Mia\Database\Query\Configure($this, $request);
        // Obtenemos información
        $rows = \Mia\Location\Repository\MiaUserAddressRepository::fetchByConfigure($configure);
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($rows->toArray());
    }
}