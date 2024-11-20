<?php

namespace App\Services\LiveWireHandlers;

class DataListingService
{

    private string $model;
    private mixed $data;
    private ?string $search_text = null;
    private int $limit = 20, $page = 1, $offset, $pagesCount, $total;
    private string $orderBy = "id", $orderDirection = "desc";
    private array $with = [], $where = [] , $whereBetween = [];

    public static function init($model = null): DataListingService
    {
        return new self($model);
    }

    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function dataListing($model = null): DataListingService
    {
        if($model) $this->model = $model;

        $this->data = $this->model::with($this->with);

        if(count($this->where))
            foreach ($this->where as $method => $cond) $this->data->{$method}($cond);

        if(count($this->whereBetween))
            foreach ($this->whereBetween as $condition) {
                $this->data->whereBetween($condition[0],array($condition[1][0], $condition[1][1]));
            }

        if($this->search_text) $this->data->search($this->search_text);

        $this->total = $this->data->count();

        $this->offset = ($this->page - 1) * $this->limit;
        if($this->limit) $this->data->skip($this->offset)->take($this->limit);
        $this->pagesCount = !$this->total || !$this->limit ? 0 : ceil($this->total / $this->limit);
        $this->data->orderBy($this->orderBy, $this->orderDirection);
        $this->data = $this->data->get();
        return $this;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @return string|null
     */
    public function getSearchText(): ?string
    {
        return $this->search_text;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getPagesCount(): int
    {
        return $this->pagesCount;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @return string
     */
    public function getOrderDirection(): string
    {
        return $this->orderDirection;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): DataListingService
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param string|null $search_text
     */
    public function setSearchText(?string $search_text): DataListingService
    {
        $this->search_text = $search_text;
        return $this;
    }

    /**
     * @param string|null $search_text
     */
    public function setWhere(array $where): DataListingService
    {
        $this->where = $where;
        return $this;
    }

    // where between
    public function setWhereBetween(array $whereBetween): DataListingService
    {
        $this->whereBetween = $whereBetween;
        return $this;
    }

    /**
     * @param string|null $search_text
     */
    public function setWith(array $with): DataListingService
    {
        $this->with = $with;
        return $this;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): DataListingService
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int $limit
     */
    public function setPage(int $page): DataListingService
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param string $orderBy
     */
    public function setOrderBy(string $orderBy): DataListingService
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param string $orderDirection
     */
    public function setOrderDirection(string $orderDirection): DataListingService
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

}
