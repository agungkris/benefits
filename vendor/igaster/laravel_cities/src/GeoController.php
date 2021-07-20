<?php

namespace Igaster\LaravelCities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class GeoController extends Controller
{
    // [Geo] Get an item by $id
    public function item($id)
    {
        $geo = Geo::find($id);
        $this->applyFilter($geo);
        return Response::json($geo);
    }

    // [Collection] Get multiple items by ids (comma seperated string or array)
    public function items($ids = [])
    {
        if (is_string($ids)) {
            $ids = explode(',', $ids);
        }

        $items = Geo::getByIds($ids);
        return Response::json($items);
    }

    // [Collection] Get children of $id
    public function children($id)
    {
        return $this->applyFilter(Geo::find($id)->getChildren());
    }

    // [Geo] Get parent of  $id
    public function parent($id)
    {
        $geo = Geo::find($id)->getParent();
        $this->applyFilter($geo);
        return Response::json($geo);
    }

    // [Geo] Get country by $code (two letter code)
    public function country($code)
    {
        $geo = Geo::getCountry($code);
        $this->applyFilter($geo);
        return Response::json($geo);
    }

    // [Collection] Get all countries
    public function countries()
    {
        return $this->applyFilter(Geo::level(Geo::LEVEL_COUNTRY)->get());
    }

    // [Collection] Search for %$name% in 'name' and 'alternames'. Optional filter to children of $parent_id
    public function search($name, $parent_id = null)
    {
        if ($parent_id) {
            return $this->applyFilter(Geo::searchNames($name, Geo::find($parent_id)));
        }
        return $this->applyFilter(Geo::searchNames($name));
    }

    public function ancestors($id)
    {
        $current = Geo::find($id);
        $ancestors = $current->ancenstors()->get()->sortBy('a1code')->values();
        $ancestors->push($current);

        $result = collect();
        foreach ($ancestors as $i => $ancestor) {
            if ($i === 0) {
                $locations = Geo::getCountries();
            } else {
                $parent = $ancestor->getParent();
                if (! $parent) {
                    continue;
                }

                $locations = $parent->getChildren();
            }

            $selected = $locations->firstWhere('id', $ancestor->id);
            $selected && $selected->isSelected = true;
            $result->push($locations);

            if ($i == $ancestors->count() - 1 && $ancestor) {
                $childrens = $ancestor->getChildren();
                if ($childrens->count()) {
                    $result->push($childrens);
                }
            }
        }

        $result = $this->applyFilter($result);

        return $result;
    }

    public function breadcrumbs($id)
    {
        $current = Geo::find($id);
        $ancestors = $current->ancenstors()->get();
        $ancestors->push($current);

        $ancestors = $this->applyFilter($ancestors);

        return $ancestors;
    }

    // Apply Filter from request to json representation of an item or a collection
    // api/call?fields=field1,field2
    protected function applyFilter($geo)
    {
        if (request()->has('fields')) {
            if (get_class($geo) == Collection::class) {
                foreach ($geo as $item) {
                    $this->applyFilter($item);
                }

                return $geo;
            }

            $fields = request()->input('fields');
            if ($fields == 'all') {
                $geo->fliterFields();
            } else {
                $fields = explode(',', $fields);
                array_walk($fields, function (&$item) {
                    $item = strtolower(trim($item));
                });
                $geo->fliterFields($fields);
            }
        }

        return $geo;
    }
}
