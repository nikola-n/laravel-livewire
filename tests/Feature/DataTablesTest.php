<?php

namespace Tests\Feature;

use App\Http\Livewire\DataTables;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Livewire\Testing\Concerns\MakesAssertions;
use Tests\TestCase;

class DataTablesTest extends TestCase
{
    use RefreshDatabase, MakesAssertions;

    //existance test

    /** @test */
    public function main_page_contains_datatables_livewire_component()
    {
        $this->get('/')
            ->assertSeeLivewire('data-tables');
    }

    /** @test */
    public function datatables_active_checkbox_works_correctly()
    {
        $userA = User::factory()->state(['active' => true])->create();
        $userB = User::factory()->state(['active' => false])->create();

        Livewire::test(DataTables::class)
            ->assertSee($userA->name)
            ->assertDontSee($userB->name)
            //uncheck
            ->set('active', false)
            ->assertSee($userB->name)
            ->assertDontSee($userA->name);
    }

    /** @test */
    public function datatables_searches_names_works_correctly()
    {
        $userA = User::factory()->state([
            'active' => true,
            'name'   => 'User',
        ])->create();
        $userB = User::factory()->state([
            'active' => false,
            'name'   => 'Another',
        ])->create();

        Livewire::test(DataTables::class)
            ->set('search', 'user')
            ->assertSee($userA->name)
            ->assertDontSee($userB->name);
    }

    /** @test */
    public function datatables_searches_emails_works_correctly()
    {
        $userA = User::factory()->state([
            'active' => true,
            'name'   => 'User',
            'email'  => 'user@user.com',
        ])->create();
        $userB = User::factory()->state([
            'active' => false,
            'name'   => 'Another',
        ])->create();

        Livewire::test(DataTables::class)
            ->set('search', 'user@user.com')
            ->assertSee($userA->name)
            ->assertDontSee($userB->name);
    }

    /** @test */
    public function datatables_sorts_name_asc_works_correctly()
    {

        $userC = User::create([
            'name'     => 'Cuco C',
            'email'    => 'cuco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        $userA = User::create([
            'name'     => 'Aco A',
            'email'    => 'aco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        $userB = User::create([
            'name'     => 'Buco B',
            'email'    => 'buco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'name')
            ->assertSeeInOrder(['Aco A', 'Buco B', 'Cuco C']);
    }

    /** @test */
    public function datatables_sorts_name_desc_works_correctly()
    {

        $userC = User::create([
            'name'     => 'Cuco C',
            'email'    => 'cuco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        $userA = User::create([
            'name'     => 'Aco A',
            'email'    => 'aco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        $userB = User::create([
            'name'     => 'Buco B',
            'email'    => 'buco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'name')
            ->call('sortBy', 'name')
            ->assertSeeInOrder(['Cuco C', 'Buco B', 'Aco A',]);
    }

    /** @test */
    public function datatables_sorts_email_asc_works_correctly()
    {

        $userC = User::create([
            'name'     => 'Cuco C',
            'email'    => 'cuco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        $userA = User::create([
            'name'     => 'Aco A',
            'email'    => 'aco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        $userB = User::create([
            'name'     => 'Buco B',
            'email'    => 'buco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'email')
            ->assertSeeInOrder(['Aco A', 'Buco B', 'Cuco C']);
    }

    /** @test */
    public function datatables_sorts_email_desc_works_correctly()
    {

        $userC = User::create([
            'name'     => 'Cuco C',
            'email'    => 'cuco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        $userA = User::create([
            'name'     => 'Aco A',
            'email'    => 'aco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        $userB = User::create([
            'name'     => 'Buco B',
            'email'    => 'buco@user.com',
            'password' => bcrypt('password'),
            'active'   => true,
        ]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'email')
            ->call('sortBy', 'email')
            ->assertSeeInOrder(['Cuco C', 'Buco B', 'Aco A',]);
    }
}
