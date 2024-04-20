<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User as Customer;
use Faker\Factory as Faker;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DataSeeder extends Component
{
    public $cbx_customer;
    public $cbx_brand;
    public $cbx_category;

    public function seedData()
    {
        if(!$this->cbx_customer && !$this->cbx_brand && !$this->cbx_category) {
            session()->flash('error', 'Please select at least one checkbox');
            return;
        }

        if ($this->cbx_customer) {
            $this->seedCustomer();
        }
        if ($this->cbx_brand) {
            $this->seedBrand();
        }
        if ($this->cbx_category) {
            $this->seedCategory();
        }

        $this->reset();
        
        session()->flash('message', 'Data seeded successfully');
    }

    public function seedCustomer()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Customer::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'username' => $faker->userName,
                'password' => Hash::make('pass@word1')
            ]);
        }
    }

    public function seedBrand()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $brand_name = $faker->company;
            Brand::create([
                'code' => 'BR' . $faker->unique()->randomNumber(5),
                'name' => $brand_name,
                'description' => $faker->sentence,
                'slug' => Str::of($brand_name)->slug('-')
            ]);
        }
    }

    public function seedCategory()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $category_name = $faker->unique()->word;
            Category::create([
                'name' => $category_name,
                'description' => $faker->sentence,
                'slug' => Str::of($category_name)->slug('-')
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.data-seeder');
    }
}
