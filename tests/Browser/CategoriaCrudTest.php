<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoriaCrudTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_categoria_crud(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Entrar')
                ->waitFor('#loginUsuario') # Importante: Espera a página de login carregar
                ->typeSlowly('loginUsuario', '1111')
                ->press('Login')
                ->waitFor('.login_logout_link')
                ->click('#navbarDropdowniclassfafausercogariahiddentrueiAdministrao') //menu
                ->pause(1250)
                ->click('a[href="categorias/create"]')
                ->pause(1250)
                ->typeSlowly('nome', 'Prédio da História e Geografia', 100)
                ->pause(2000)
                ->press('Enviar')
                ->pause(2000)
                ->assertSee('Prédio da História e Geografia');
            
            $browser->click('a[title="Editar"]')
                ->typeSlowly('nome', 'Prédio da Letras')
                ->pause(2000)
                ->press('Enviar')
                ->assertSee('Prédio da Letras');

            $browser->click('button[title="Excluir"]')
                ->pause(2000)
                ->acceptDialog()
                ->pause(2000)
                ->assertSee('Categoria excluída com sucesso.');
        });
    }
}