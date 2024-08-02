<?php

namespace  App\Repositories;


interface WebsiteRepositoryInterface
{
    public function store(string $url);
    public function show(int $id);
    public function update(string $url, int $id);
    public function getReportsDataById(int $websiteId);
    public function getWebsiteDataById(int $websiteId);
    public function delete(int $id);
}
