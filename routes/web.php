<?php

use App\Http\Controllers\AditionalController;
use App\Http\Controllers\AdressController;
use App\Http\Controllers\CartModelController;
use App\Http\Controllers\CartOrderController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\BlindController;
use App\Http\Controllers\BlindCartController;
use App\Http\Controllers\bomboniereController;
use App\Http\Controllers\deliveredController;
use App\Http\Controllers\deliveryController;
use App\Http\Controllers\NewProjctsController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\productionController;
use App\Http\Controllers\ProductStatusController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\statusRefusedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckNewOrderController;
use App\Http\Controllers\DeliveryBlindController;
use App\Http\Controllers\ListModelController;
use App\Http\Controllers\updateAdminController;
use App\Http\Controllers\panelAdminController;
use App\Http\Controllers\pointsController;
use App\Http\Controllers\PoliticaPrivacidadeController;
use App\Http\Controllers\summaryController;
use App\Http\Controllers\toggleController;
use App\Http\Controllers\verificationOrderController;
use App\Http\Controllers\WaitingTimeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StatusDeniedController;
use App\Http\Controllers\TermsUseController;
use App\Http\Controllers\UpdateTotalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//    crud
// Route::get('/produts',ProjectCreate::class);

Route::get('/create',[CreateController::class,'index'])->name('create.product')->middleware('can:access');
Route::post('/store',[CreateController::class, 'store'])->name('store.product');
Route::delete('/delete/{id}',[CreateController::class, 'delete'])->name('delete.product');
Route::put('/update/{id}',[CreateController::class, 'update'])->name('update.product');

Route::get('/showbeer',[ShowController::class, 'show'])->name('showbeer');
Route::get('/showcombo',[ShowController::class, 'shows'])->name('showcombo');
Route::get('/showbomboniere',[bomboniereController::class, 'show'])->name('show.bomboniere');

// view client

Route::get('/dashboard',[ClientController::class, 'index'])->middleware('auth')->name('client.show');
Route::get('/beer',[ShowController::class,'index'])->name('users.beer');
Route::get('/combo',[ShowController::class, 'combo'])->name('user.combo');
Route::get('/bomboniere',[bomboniereController::class, 'index'])->name('user.bomboniere');

        // cart

Route::post('/cartstore/{id}',[OrderProductController::class, 'store'])->name('store.cart');
Route::post('/cartberr/{id}',[OrderProductController::class, 'storebeer'])->name('storebeer');
Route::get('/cartshow', [OrderProductController::class, 'show'])->name('cart.show');
Route::post('/delete/{id}',[OrderProductController::class, 'delete'])->name('cart.delete');

   //adress

Route::post('/adress',[AdressController::class, 'create'])->name('adress.create');


// order

Route::get('/showorder', [adminController::class, 'index'])->name('order.show');
Route::post('/adminCreateCart',[adminController::class, 'store'])->name('admin.create');

 //rota para criar o pedido com blinde

// Route::post('/adminCreateBlind/{i}', [AdminController2::class, 'store'])->name('admin.createBlind');

// update in status

Route::post('/updateStatus/{id}', [adminController::class, 'update'])->name('update.status');

//   rota de status dos pedidos
Route::post('/statusrefused,{id}',[statusRefusedController::class, 'update'])->name('refused.status');
Route::get('/statusAceito', [statusController::class, 'index'])->name('status.aceito');
Route::post('/updateProduct,{id}', [statusController::class, 'update'])->name('status.product');

Route::get('/production', [productionController::class, 'index'])->name('production.index');
Route::post('/updateDelivery,{id}', [productionController::class, 'update'])->name('status.delivery');

Route::get('/delivery', [deliveryController::class, 'index'])->name('status.fordelivery');
Route::post('/delivered,{id}',[deliveryController::class, 'update'])->name('status.fordelivered');

Route::get('/delivereds',[deliveredController::class, 'index'])->name('status.delivered');

        //   controller que vai gerar pdf para impressão

Route::get('/pdfpreper,{id}',[pdfController::class, 'index'])->name('pdf.index');

        // rota que imprimir de fato
Route::post('/pdfimprimird,{id}',[pdfController::class, 'create'])->name('pdf.imprimird');

       //rota para mudar o status do produto para ativo e vice versa

Route::post('/statusProduct,{id}',[ProductStatusController::class, 'update'])->name('product.update');

       //rota para abrir e fechar a loja

Route::post('/is_open',[ClientController::class, 'toggle'])->name('toggle.open');

       //rota para verificar is_open para sinal de notificação

Route::get('/statusLanchonete',[toggleController::class, 'status'])->name('status.lanchonete');

     //rota sonora

Route::get('/alert-sound', function ()  {
    return response()->file(public_path('sounds/new_order.mp3'));
})->name('aler-sound');

//  rota de cadastro para criar novosprodutos

Route::get('/newProducts',[NewProjctsController::class, 'show'])->name('new.project');

    // rota para cadastrar categorias visualizar e excluir

Route::get('/view-category',[CategoryController::class, 'index'])->name('view.category');
Route::post('/create-category', [CategoryController::class, 'create'])->name('create.category');
Route::post('/categoryDelet,{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    //  rota para cadastra novo adicional

Route::get('/view-aditional', [AditionalController::class, 'index'])->name('view.aditional');
Route::post('/create-additional', [AditionalController::class, 'create'])->name('create.additional');
Route::post('/additionalDelete,{id}',[AditionalController::class, 'destroy'])->name('additional.delete');
Route::put('/additionalUpdate,{id}',[AditionalController::class, 'update'])->name('additional.update');

    //    rota para adicionar administrador no sistema

Route::post('/update-admin',[updateAdminController::class, 'update'])->name('update.admin');

        //  view admin

Route::get('/panel-admin',[panelAdminController::class, 'index'])->name('panel.admin')->middleware('can:access');

    // rota de resumo dos pedidos graficos
Route::get('/summary',[summaryController::class, 'index'])->name('summary.index');
Route::post('/summary/filter', [SummaryController::class, 'filter'])->name('summary.filter');
Route::post('/search',[summaryController::class, 'search'])->name('summary.search');
Route::get('/salesData',[summaryController::class, 'salesChartData'])->name('summary.sales');
Route::get('/productQuantity',[summaryController::class, 'productGraphic'])->name('summary.product');
require __DIR__.'/auth.php';

       //rota de visualização dos pontos

Route::get('/points', [pointsController::class, 'index'])->name('index.point');
Route::get('/creatpoints', [pointsController::class, 'show'])->name('createpoints');

     //cria os blindes em si

Route::post('upload/points', [pointsController::class,'store'])->name('upload.points');

    //deletar os blindes
Route::post('destroy/points,{id}', [pointsController::class,'destroy'])->name('delete.points');



    //rota para cadastrar o regate dos blinedes

Route::post('/create-blind,{id}', [BlindController::class, 'create'])->name('blind.create');

  //rota para adiministrador visualizar o resgate

Route::get('index-blind', [BlindController::class, 'index'])->name('blind.index');

  //rota de update do blinde
Route::post('/update-blind, {id}', [BlindController::class, 'update'])->name('blind.update');

  //rota para mostrar pedidos entregues

Route::get('/blind-show', [BlindController::class, 'show'])->name('blind.show');

//rota para escolher como retirar o blinde

Route::get('/delivery-index', [DeliveryBlindController::class, 'index'])->name('delivery.index');

Route::get('delivery-toremove', [DeliveryBlindController::class, 'show'])->name('delivery.show');

 //rota para ciar blindcart

Route::post('/create-blindCart,{id}', [BlindCartController::class, 'store'])->name('blindcart.store');

//rota para cadastrar tempo de espera da entrega

Route::post('/waitingtime-create', [WaitingTimeController::class, 'create'])->name('waitngtime.create');

Route::get('/waitingtime-index', [WaitingTimeController::class, 'index'])->name('waintingtime.index');

//  rota para cadastrar produtos da lista de compra

Route::get('/list',[ListModelController::class, 'index'])->name('list.index');

//rota para cadstrar item da lista

Route::post('/list-create', [ListModelController::class, 'create'])->name('list.create');

//rota para excluir iten da lista

Route::delete('/list-delete,{id}', [ListModelController::class, 'delete'])->name('list.delete');

Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

//rota para verificar se há novo pedido

Route::get('/checkNewOrder',[CheckNewOrderController::class, 'index'])->name('checkneworder');

  //rota para acessar pedidos recusados

 Route::get('/order-denied', [StatusDeniedController::class, 'show'])->name('status.denied');

  //rota para redenrizar view de politica de privacidade

Route::get('/privacidade', [PoliticaPrivacidadeController::class, 'index'])->name('privacidade.index');

  //rota para mostrar a view de politica de uso

Route::get('/terms-use', [TermsUseController::class, 'index'])->name('terms.index');

  //rota para o usuario pedir exclusão de seus dados

Route::get('/data-deletion', [TermsUseController::class, 'deletion'])->name('data.deletion');

   //rota para atualizar o valor com taxa de entrega

Route::get('/product-info', [UpdateTotalController::class, 'show'])->name('product.info.index');

   //rota para atualizar modo de pagamento
   
Route::post('/update-paymemte', [OrderProductController::class, 'updatepaymente'])->name('update.paymente'); 

    //rota para alterar delivery
    
Route::post('/update-delivery', [OrderProductController::class, 'updateDelivery'])->name('update.delivery');









