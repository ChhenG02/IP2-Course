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

/**
 * Test ID: CAT-003
 * Description: Check if we can get a single category by ID
 */
public function test_get_single_category(): void
{
    $category = Category::create(['name' => 'Books']);

    $response = $this->get("/api/categories/{$category->id}");

    $response->assertStatus(200)
             ->assertJson([
                 'id' => $category->id,
                 'name' => 'Books',
             ]);
}

/**
 * Test ID: CAT-004
 * Description: Check if a category can be updated
 */
public function test_update_category(): void
{
    $category = Category::create(['name' => 'Old Name']);

    $response = $this->patch("/api/categories/{$category->id}", [
        'name' => 'New Name',
    ]);

    $response->assertStatus(200)
             ->assertJson([
                 'message' => 'Category updated successfully',
                 'category' => ['name' => 'New Name'],
             ]);

    $this->assertDatabaseHas('categories', ['name' => 'New Name']);
}

/**
 * Test ID: CAT-005
 * Description: Check if a category can be soft-deleted
 */
public function test_delete_category(): void
{
    $category = Category::create(['name' => 'To be deleted']);

    $response = $this->delete("/api/categories/{$category->id}");

    $response->assertStatus(200)
             ->assertJson(['message' => 'Category deleted successfully']);

    $this->assertSoftDeleted('categories', ['id' => $category->id]);
}

/**
 * Test ID: CAT-006
 * Description: Check if we can create a category through the API
 */
public function test_create_category_via_api(): void
{
    $response = $this->post('/api/categories', [
        'name' => 'Clothing',
    ]);

    $response->assertStatus(200)
             ->assertJson([
                 'message' => 'Creating a new category',
                 'category' => ['name' => 'Clothing'],
             ]);

    $this->assertDatabaseHas('categories', ['name' => 'Clothing']);
}

}