<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h1 class="mb-10 text-4xl font-semibold leading-tight text-gray-800">
                    {{ __('주문') }}
                </h1>

                @if ($products_info->count() > 0)
                <table class="w-full h-full text-center table-auto">
                    <tr>
                        <td class="w-1/12"></td>
                        <td class="w-5/12 ">상품명</td>
                        <td class="w-1/12 ">상품개수</td>
                        <td class="w-1/12 ">가격</td>
                    </tr>

                    @foreach ($products_info as $product)
                    <tr>
                        <td class="flex justify-center">
                            <img class="object-contain w-48 h-36" src="/storage/images/{{ $product->img }}">
                        </td>

                        <td>{{ $product->name }}</td>
                        <td class="">{{ $product->count }}</td>
                        <td>{{ $product->total_price }}</td>
                    </tr>
                    @endforeach

                </table>
                <div class="w-full h-24 pt-6 pr-4 mt-10 bg-gray-50">
                    <h1 class="text-4xl text-end">{{ $price }}₩</h1>
                </div>

                <div>
                    <h1>{{ Auth::user()->name }}</h1>
                    <h1>{{ Auth::user()->email }}</h1>
                    <h1>{{ Auth::user()->phone }}</h1>
                </div>

                @endif
                <form class="mt-10" method="POST" action="{{ route('order_success') }}">
                    <!-- Postal Code -->
                    @csrf
                    <x-text-input type="hidden" name="dd" value="{{ json_encode($products_info) }}" />
                    <div>
                        <x-input-label for="Postal code" :value="__('우편번호')" />
                        <div class="flex items-center">
                            <x-text-input id="postal_code" class="block mt-1" type="text" placeholder="우편번호" name="postal_code" :value="old('postal_code')" required readonly />
                            <x-primary-button class="ml-2" onclick="execDaumPostcode()">
                                {{ __('주소 검색') }}
                            </x-primary-button>
                        </div>
                        <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="mt-4 ">
                        <label class="block text-sm font-medium text-gray-700'" for="roadAddress">주소</label>
                        <div class="flex items-center">
                            <input type="text" id="roadAddress" class='border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' name="roadAddress" placeholder="도로명주소" required readonly>
                            <input type="text" id="detailAddress" class='border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' name="detailAddress" placeholder="상세주소">
                            <input type="text" id="extraAddress" class='border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' name="extraAddress" placeholder="참고항목" readonly>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Order') }}
                        </x-primary-button>
                    </div>
                </form>
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
                    if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                        extraRoadAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if (data.buildingName !== '' && data.apartment === 'Y') {
                        extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if (extraRoadAddr !== '') {
                        extraRoadAddr = ' (' + extraRoadAddr + ')';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('postal_code').value = data.zonecode;
                    document.getElementById("roadAddress").value = roadAddr;
                    // document.getElementById("jibunAddress").value = data.jibunAddress;

                    // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                    if (roadAddr !== '') {
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