<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h1 class="mb-10 text-4xl font-semibold leading-tight text-gray-800">
                    {{ __('주문') }}
                </h1>

                @if ($products_info->count() > 0)
                    <table class="w-full h-full mb-3 text-center">
                        <tr class="h-12 font-semibold text-gray-800 bg-gray-300">
                            <td class="w-1/12"></td>
                            <td class="w-5/12 ">상품명</td>
                            <td class="w-1/12 ">상품개수</td>
                            <td class="w-1/12 ">가격</td>
                        </tr>

                        @foreach ($products_info as $product)
                            <tr class="h-full border-b">
                                <td class="flex justify-center">
                                    <img class="hidden object-contain p-3 w-52 md:table-cell" src="/storage/images/{{ $product->img }}">
                                </td>

                                <td>{{ $product->name }}</td>
                                <td class="">{{ $product->count }}</td>
                                <td>{{ $product->total_price }}</td>
                            </tr>
                        @endforeach

                    </table>
                    <h1 class="mt-6 mr-3 text-3xl text-end">{{ $price }}&nbsp₩</h1>



                    <div class="flex flex-col w-full h-full px-3 py-6 mt-16 bg-gray-50">

                        <table>
                            <tr class="">
                                <td class="w-2/5">이름</td>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <td>이메일</td>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <td>휴대전화</td>
                                <td>{{ Auth::user()->phone }}</td>
                            </tr>
                        </table>

                        <form class="flex flex-col justify-center mt-10 " method="POST" action="{{ route('order_success') }}">
                            <!-- Postal Code -->
                            @csrf
                            <x-text-input type="hidden" name="dd" value="{{ json_encode($products_info) }}" />
                            <div class="w-full ">
                                <x-input-label for="Postal code" :value="__('우편번호')" />
                                <div class="">
                                    <x-text-input id="postal_code" class="mt-1 mb-1 " type="text" placeholder="우편번호" name="postal_code"
                                                  :value="old('postal_code')" required readonly/>
                                    <button class="px-3 py-2 text-gray-100 bg-gray-700  rounded-xl" onclick="execDaumPostcode()">
                                        {{ __('주소 검색') }}
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                            </div>

                            <!-- Address -->
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700'" for="roadAddress">주소</label>
                                <div  class ="flex flex-col">
                                    <div class="flex gap-2 mb-2 flex-flow-col">
                                        <input type="text" id="roadAddress" class = 'flex-grow mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                                               name="roadAddress" placeholder="도로명주소" required readonly>
                                        <input type="text" id="extraAddress"class = 'flex-grow border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                                               name="extraAddress" placeholder="참고주소" readonly>
                                    </div>

                                    <input type="text" id="detailAddress" class = 'border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
                                           name="detailAddress" placeholder="상세주소">

                                </div>
                            </div>
{{--                            <h1 class="mt-10 ml-2 text-3xl ">{{ $price }}&nbsp₩</h1>--}}
                            <div class="flex items-center justify-end mt-28">
                                <x-primary-button class="ml-4">
                                    {{ __('Order') }}
                                </x-primary-button>
                            </div>
                        </form>

                    </div>



                @endif

            </div>
        </div>
    </div>
    @push('scripts')
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
         function execDaumPostcode() {
        event.preventDefault();
        document.getElementById('postal_code').removeAttribute('readonly')
        document.getElementById("roadAddress").removeAttribute('readonly')
        document.getElementById("extraAddress").removeAttribute('readonly')
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var roadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 참고 항목 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('postal_code').value = data.zonecode;
                document.getElementById("roadAddress").value = roadAddr;
                // document.getElementById("jibunAddress").value = data.jibunAddress;

                // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                if(roadAddr !== ''){
                    document.getElementById("extraAddress").value = extraRoadAddr;
                } else {
                    document.getElementById("extraAddress").value = '';
                }
                document.getElementById('postal_code').setAttribute('readonly', 'readonly')
                document.getElementById("roadAddress").setAttribute('readonly', 'readonly')
                document.getElementById("extraAddress").setAttribute('readonly', 'readonly')
            }
        }).open();
    }
    </script>
    @endpush
</x-app-layout>
