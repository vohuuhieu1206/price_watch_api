<?php

namespace App\Http\Middleware;

use Closure;

class TransformInput
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $transformer)
    {
        $transformedInput = [];
        foreach ($request->all() as $input => $value)
        {
            $transformedInput[$transformer::originalAttribute($input)] = $value;
        }

        $request->replace($transformedInput);

        $response = $next($request);

        if (isset($response->exception) && $response->exception instanceof ValidationException){

            $data = $response->getData();

            $transformedError = [] ;

            foreach($data->error as $field => $error){

                $transformedField = $transformer::transformedlAttribute($field);

                $transformedError[$transformedField] = str_replace($field, $transformedField, $error);
            }

            $data->error = $transformedError;

            $response->setData($data);
        }
        return $response;
    }
}
