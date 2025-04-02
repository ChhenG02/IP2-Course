<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test ID: CAT-001
     * Description: Check if a category can be created
     * Precondition: Database is migrated and empty
     * Test Steps:
     *   1. Create a new category with name 'Electronics'
     *   2. Check if the category exists in the database
     * Test Data: ['name' => 'Electronics']
     * Expected Result: The category should exist in the database
     * Actual Result: The category exists in the database
     * Status: Passed
     * Remark: None
     */
    public function test_a_category_can_be_created(): void
    {
        // Test Step 1: Create category
        $category = Category::create(['name' => 'Electronics']);

        // Test Step 2: Assert database has the record
        $this->assertDatabaseHas('categories', ['name' => 'Electronics']);
    }

    /**
     * Test ID: CAT-002
     * Description: Check if we can access the get all categories API
     * Precondition: None
     * Test Steps:
     *   1. Hit the get all categories API
     *   2. Check if the response status is 200
     * Test Data: None
     * Expected Result: The response status should be 200 with success message
     * Actual Result: The response status is 200 with success message
     * Status: Passed
     * Remark: None
     */
    public function test_if_we_can_access_get_all_categories_api(): void
{
    $response = $this->get('/api/categories');
    $response->assertStatus(200)
    ->assertJson([
        'message' => 'success',
        'data' => []
    ]);
}
}