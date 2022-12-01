<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('count');
            $table->string('postal_code');
            $table->string('address');
            $table->boolean('state')->default(false);
            $table->timestamps();

// 주문 상태 - 0, 1
// 0 : 주문 접수 중 - 고객님의 주문과 결제 정보가 접수되었습니다. 지금은 주문을 변경할 수 없지만 주문 처리 준비를 시작하면 변경할 수 있습니다.
// 1 : 주문 처리 완료 - 주문 처리에 필요한 모든 정보가 접수되었습니다. 제품이 준비되는 대로 소식을 보내 드리고 출고를 준비하겠습니다. 지금도 주문을 변경할 수 있습니다.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};