@extends('front.master')

@section('content')
    <div class="w-full h-screen flex flex-col bg-gradient-to-b from-gray-50 to-gray-100 font-sans">

        <!-- Header -->

        <div class="flex items-center justify-between p-4 bg-white shadow-md relative">

            <!-- Left: hamburger + logo -->
            <div class="flex items-center gap-4">
                <!-- Hamburger -->
                <button class="text-gray-700 text-3xl font-bold" onclick="toggleSidebar()">
                    ☰
                </button>

                <!-- Logo -->
                <span class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-500">
            automata-ai
        </span>
            </div>

            <!-- Right: user + logout -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <img class="w-10 h-10 rounded-full border-2 border-indigo-200"
                         src="https://placehold.co/40x40" alt="Profile">
                    <span class="text-sm font-semibold text-gray-700">
                {{ auth()->user()->full_name }}
            </span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg text-sm font-medium">
                        خروج
                    </button>
                </form>
            </div>
        </div>

        <!-- Hamburger menu -->
        <!-- Hamburger menu -->
        <div id="sidebar"
             class="fixed left-0 top-0 h-full w-64 bg-indigo-600 text-white transform -translate-x-full transition-all duration-300 z-50">

            <div class="p-4 border-b border-gray-700 text-lg font-bold">
                تاریخچه چت
            </div>

            <ul class="p-4 space-y-3">
                <li class="cursor-pointer hover:text-blue-400" onclick="filterChats('all')">همه چت‌ها</li>
                <li class="cursor-pointer hover:text-blue-400" onclick="filterChats('dfa')">چت‌های DFA</li>
                <li class="cursor-pointer hover:text-blue-400" onclick="filterChats('nfa')">چت‌های NFA</li>
                <li class="cursor-pointer hover:text-blue-400" onclick="filterChats('regex')">چت‌های Regex</li>
            </ul>
        </div>




        <!-- DFA / NFA Form -->
        <!-- DFA / NFA Form -->
        <div id="automatonForm" class="p-4 bg-white rounded-xl shadow-md m-4 border border-gray-200 hidden">
            <div class="flex justify-between items-center mb-2">
                <h3 id="formTitle" class="font-bold text-lg">تعریف جدول انتقال</h3>
                <button id="closeForm" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">بستن</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-indigo-100 text-indigo-800">
                    <tr>
                        <th class="border px-3 py-2">From State</th>
                        <th class="border px-3 py-2">Input Symbol</th>
                        <th class="border px-3 py-2">To State</th>
                        <th class="border px-3 py-2">Action</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    <tr class="hover:bg-indigo-50">
                        <td><input type="text" class="border px-1 py-1 w-full state-from rounded"/></td>
                        <td><input type="text" class="border px-1 py-1 w-full input-symbol rounded"/></td>
                        <td><input type="text" class="border px-1 py-1 w-full state-to rounded"/></td>
                        <td>
                            <button type="button" class="addRow bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">+</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-3 flex flex-wrap gap-3 items-center">
                <label>Start State: <input id="startState" class="border px-2 py-1 rounded"></label>
                <label>Accept States: <input id="acceptStates" class="border px-2 py-1 rounded" placeholder="q2,q3"></label>
                <label>Alphabet: <input id="alphabetInput" class="border px-2 py-1 rounded" placeholder="a,b,c,..."></label>
                <button type="button" id="generateAutomaton" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">ارسال</button>
            </div>
            <div id="errorContainer" class="mt-3 p-3 bg-red-50 border border-red-300 rounded-lg text-red-700 text-sm hidden"></div>
        </div>

        <!-- Messages -->
        <div id="messages" class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50">
            @forelse($messages as $msg)
                @if($msg->sender === 'user')
                    <div class="flex justify-end items-start gap-4">
                        <div class="bg-indigo-600 text-white p-4 rounded-2xl max-w-lg shadow-lg flex flex-col gap-2">
                            <p class="text-sm">{{ $msg->message }}</p>
                            <span class="text-xs text-indigo-100 self-end">{{ $msg->created_at->format('H:i') }}</span>
                        </div>
                    </div>
                @else
                    <div class="flex justify-start items-start gap-4">
                        <div class="bg-white text-gray-700 p-4 rounded-2xl shadow-lg max-w-lg flex flex-col gap-2">
                            @if($msg->type==='image' && $msg->image)
                                <img src="{{ $msg->image }}" class="mb-2 max-w-full rounded-lg"/>
                            @endif
                            <p>{{ $msg->message }}</p>
                            <span class="text-xs text-gray-400">{{ $msg->created_at->format('H:i') }}</span>
                        </div>
                    </div>
                @endif
            @empty
                <div class="text-center text-gray-500 py-12">
                    <p class="text-lg font-medium">سلام {{ auth()->user()->full_name }}! 👋</p>
                    <p class="text-sm">با automata-ai چت کن...</p>
                </div>
            @endforelse
        </div>

        <!-- Input -->
        <!--div class="p-4 bg-white border-t border-gray-200 shadow-md flex items-center gap-4">
            <input id="messageInput" type="text" placeholder="پیام به automata-ai" class="flex-1 p-3 rounded-full border border-gray-200 bg-gray-50"/>
            <button id="sendBtn" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-full font-semibold hover:from-indigo-700 hover:to-indigo-800">ارسال</button>
        </div-->



        <!-- Input + آپلود PDF (اضافه شده، جایگزین نشده) -->
        <div class="p-4 bg-white border-t border-gray-200 shadow-md space-y-3">

            <!-- ناحیه Drag & Drop PDF -->
            <div id="dropZone"
                 class="p-3 border-2 border-dashed border-gray-300 rounded-xl text-center text-gray-500
                hover:border-indigo-500 hover:bg-indigo-50 transition cursor-pointer text-sm"
                 onclick="document.getElementById('pdfInput').click()">
                <span>📎 فایل PDF را اینجا بکشید یا کلیک کنید (اختیاری)</span>
                <p id="selectedFileName" class="text-xs text-indigo-600 mt-1 hidden"></p>
            </div>

            <input type="file" id="pdfInput" accept="application/pdf" class="hidden">

            <!-- همان اینپوت و دکمه قبلی -->
            <div class="flex items-center gap-4">
                <input id="messageInput" type="text"
                       placeholder="پیام به automata-ai (متن یا سوال در مورد PDF)"
                       class="flex-1 p-3 rounded-full border border-gray-200 bg-gray-50"/>
                <button id="sendBtn"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-full font-semibold hover:from-indigo-700 hover:to-indigo-800">
                    ارسال
                </button>
            </div>
        </div>





    </div>













    <script>
        document.addEventListener('DOMContentLoaded', () => {




            const dropZone = document.getElementById('dropZone');
            const pdfInput = document.getElementById('pdfInput');
            const selectedFileName = document.getElementById('selectedFileName');
            let selectedPdf = null;

            pdfInput.addEventListener('change', e => handleFile(e.target.files[0]));

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
                dropZone.addEventListener(evt, e => {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            ['dragenter', 'dragover'].forEach(evt => {
                dropZone.addEventListener(evt, () => {
                    dropZone.classList.add('border-indigo-500', 'bg-indigo-50');
                });
            });

            ['dragleave', 'drop'].forEach(evt => {
                dropZone.addEventListener(evt, () => {
                    dropZone.classList.remove('border-indigo-500', 'bg-indigo-50');
                });
            });

            dropZone.addEventListener('drop', e => {
                handleFile(e.dataTransfer.files[0]);
            });

            function handleFile(file) {
                if (!file) return;
                if (file.type !== 'application/pdf') {
                    alert('فقط فایل PDF مجاز است');
                    return;
                }
                if (file.size > 10 * 1024 * 1024) {
                    alert('حجم فایل نباید بیشتر از ۱۰ مگابایت باشد');
                    return;
                }
                selectedPdf = file;
                selectedFileName.textContent = `📄 ${file.name}`;
                selectedFileName.classList.remove('hidden');
            }










































            const input = document.querySelector('#messageInput');
            const sendBtn = document.querySelector('#sendBtn');
            const messages = document.querySelector('#messages');
            const automatonForm = document.getElementById('automatonForm');
            const closeForm = document.getElementById('closeForm');
            const formTitle = document.getElementById('formTitle');
            const tableBody = document.getElementById('tableBody');
            const generateBtn = document.getElementById('generateAutomaton');

            let currentAutomaton = ''; // dfa یا nfa
            let hasUnresolvedError = false; // وضعیت خطا

            // ایجاد کانتینر خطاها
            let errorContainer = document.getElementById('errorContainer');
            if (!errorContainer) {
                errorContainer = document.createElement('div');
                errorContainer.id = 'errorContainer';
                errorContainer.className = 'mt-3 p-3 bg-red-50 border border-red-300 rounded-lg text-red-700 text-sm space-y-1 hidden';
                automatonForm.querySelector('.flex.flex-wrap').appendChild(errorContainer);
            }

            // نمایش خطاها
            function showErrors(errors) {
                hasUnresolvedError = true;
                errorContainer.innerHTML = '<ul class="list-disc list-inside">' +
                    errors.map(err => `<li>${err}</li>`).join('') +
                    '</ul>';
                errorContainer.classList.remove('hidden');
                automatonForm.classList.remove('hidden'); // همیشه باز بماند
            }

            // مخفی کردن خطاها
            function hideErrors() {
                hasUnresolvedError = false;
                errorContainer.classList.add('hidden');
            }

            // بررسی خطا در پاسخ بات
            // تشخیص خطا از پاسخ بات — پوشش ۱۰۰٪ خطاهای FastAPI
            // تشخیص خطا از پاسخ بات — پوشش ۱۰۰٪ خطاهای DFA/NFA + آینده‌نگری
            function isErrorMessage(text) {
                // لیست کلمات کلیدی که نشان‌دهنده خطا هستند
                const errorKeywords = [
                    'خطا',
                    'اشتباه',
                    'نامعتبر',
                    'فرمت',
                    'JSON',
                    'وجود ندارد',
                    'مقصد ندارد',
                    'تعارض',
                    'الزامی',
                    'نیست',
                    'ناقص',
                    'حدل',
                    'قبول نمی‌شود',
                    'رد شد',
                    'معتبر نیست',
                    'باید در میان states',
                    'state',
                    'symbol',
                    'transition',
                    'missing',
                    'invalid',
                    'error'
                ];

                // اگر هر کدوم از این کلمات توی پیام باشه → خطا
                return errorKeywords.some(keyword =>
                    text.toLowerCase().includes(keyword.toLowerCase())
                );
            }

            // اعتبارسنجی جدول
            function validateAutomaton() {
                const rows = document.querySelectorAll('#tableBody tr');
                const transitions = {};
                const errors = [];

                rows.forEach((row, index) => {
                    const from = row.querySelector('.state-from').value.trim();
                    const inputSym = row.querySelector('.input-symbol').value.trim();
                    const to = row.querySelector('.state-to').value.trim();

                    if (!from && !inputSym && !to) return;
                    if (!from || !inputSym || !to) {
                        errors.push(`ردیف ${index + 1}: همه فیلدها باید پر شوند.`);
                        return;
                    }

                    if (!transitions[from]) transitions[from] = {};
                    if (transitions[from][inputSym] && transitions[from][inputSym] !== to) {
                        errors.push(`تعارض: "${from}" با "${inputSym}" به دو حالت مختلف می‌رود.`);
                    }
                    transitions[from][inputSym] = to;
                });

                if (Object.keys(transitions).length === 0) {
                    errors.push('حداقل یک انتقال وارد کنید.');
                    return { valid: false, errors };
                }

                const allFromStates = Object.keys(transitions);
                const allToStates = Object.values(transitions).flatMap(obj => Object.values(obj));
                const allStates = [...new Set([...allFromStates, ...allToStates])];

                const startState = document.getElementById('startState').value.trim();
                if (!startState) errors.push('حالت شروع الزامی است.');

                const acceptStatesInput = document.getElementById('acceptStates').value.trim();
                const acceptStates = acceptStatesInput ? acceptStatesInput.split(',').map(s => s.trim()).filter(s => s) : [];

                if (startState && !allStates.includes(startState)) {
                    errors.push(`حالت شروع "${startState}" در جدول وجود ندارد.`);
                }
                acceptStates.forEach(state => {
                    if (!allStates.includes(state)) {
                        errors.push(`حالت پذیرش "${state}" در جدول وجود ندارد.`);
                    }
                });

                // گرفتن الفبا از input
                const alphabetInput = document.getElementById('alphabetInput').value.trim();
                const alphabet = alphabetInput ? alphabetInput.split(',').map(s => s.trim()) : [];

                if (currentAutomaton === 'dfa' || currentAutomaton === 'regex') {
                    allFromStates.forEach(state => {
                        alphabet.forEach(sym => {
                            if (!transitions[state]?.[sym]) {
                                errors.push(`${currentAutomaton.toUpperCase()}: حالت "${state}" برای "${sym}" انتقال ندارد.`);
                            }
                        });
                    });
                }

                return { valid: errors.length === 0, errors, transitions, allStates, startState, acceptStates, alphabet };
            }

// generateBtn listener
            // ==================== ارسال جدول DFA/NFA ====================
            generateBtn.addEventListener('click', async () => {
                hideErrors();
                const validation = validateAutomaton();

                if (!validation.valid) {
                    showErrors(validation.errors);
                    return;
                }

                const { transitions, allStates, startState, acceptStates } = validation;

                const automatonJSON = {
                    states: allStates,
                    alphabet: [...new Set(Object.values(transitions).flatMap(t => Object.keys(t)))],
                    transitions,
                    start: startState,
                    accept: acceptStates
                };

                const fullMessage = `${currentAutomaton} ${JSON.stringify(automatonJSON)}`;
                input.value = fullMessage;

                input.disabled = true;
                sendBtn.disabled = true;
                generateBtn.disabled = true;

                try {
                    const res = await fetch('{{ route("front.chat.send") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ message: fullMessage })
                    });

                    const data = await res.json();

                    if (data.success) {
                        data.messages.forEach(msg => {
                            const html = `
                    <div class="flex ${msg.sender === 'user' ? 'justify-end' : 'justify-start'} items-start gap-4">
                        <div class="${msg.sender === 'user' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'} p-4 rounded-2xl max-w-lg shadow-lg">
                            ${msg.type === 'image' && msg.image ? `<img src="${msg.image}" class="mb-2 max-w-full rounded-lg" alt="automaton"/>` : ''}
                            <p>${msg.message}</p>
                            <span class="text-xs ${msg.sender === 'user' ? 'text-indigo-100' : 'text-gray-400'} self-end">
                                ${new Date(msg.created_at).toLocaleTimeString('fa-IR', { hour: '2-digit', minute: '2-digit' })}
                            </span>
                        </div>
                    </div>`;
                            messages.insertAdjacentHTML('beforeend', html);
                        });
                        messages.scrollTop = messages.scrollHeight;

                        const lastBotMsg = data.messages.findLast(m => m.sender === 'bot');
                        if (lastBotMsg && isErrorMessage(lastBotMsg.message)) {
                            showErrors([lastBotMsg.message]);
                            return;
                        }

                        // موفقیت
                        hideErrors();
                        automatonForm.classList.add('hidden');

                        // پاک کردن فرم
                        tableBody.innerHTML = `
                <tr class="hover:bg-indigo-50">
                    <td><input type="text" class="border px-1 py-1 w-full state-from rounded"/></td>
                    <td><input type="text" class="border px-1 py-1 w-full input-symbol rounded"/></td>
                    <td><input type="text" class="border px-1 py-1 w-full state-to rounded"/></td>
                    <td><button type="button" class="addRow bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">+</button></td>
                </tr>`;
                        document.getElementById('startState').value = '';
                        document.getElementById('acceptStates').value = '';
                        document.getElementById('alphabetInput').value = '';
                        input.value = '';
                    } else {
                        showErrors(['خطا در پردازش درخواست. لطفاً دوباره تلاش کنید.']);
                    }
                } catch (err) {
                    console.error(err);
                    showErrors(['خطای ارتباط با سرور. اتصال اینترنت خود را بررسی کنید.']);
                } finally {
                    input.disabled = false;
                    sendBtn.disabled = false;
                    generateBtn.disabled = false;
                }
            });













           /* generateBtn.addEventListener('click', async () => {
                hideErrors();
                const validation = validateAutomaton();

                if (!validation.valid) {
                    showErrors(validation.errors);
                    return;
                }

                const { transitions, allStates, startState, acceptStates, alphabet } = validation;
                const automatonJSON = {
                    states: allStates,
                    alphabet: alphabet,
                    transitions,
                    start: startState,
                    accept: acceptStates
                };

                // ادامه ارسال به بات و مدیریت فرم و خطا مانند قبل...
            });*/


            // بستن فرم — فقط اگر خطا نباشد
            closeForm.addEventListener('click', () => {
                if (hasUnresolvedError) {
                    alert('ابتدا خطاها را برطرف کنید!'); // یا می‌تونید غیرفعال کنید
                    return;
                }
                automatonForm.classList.add('hidden');
                hideErrors();
            });

            // اضافه/حذف ردیف
            document.addEventListener('click', e => {
                if (e.target.classList.contains('addRow')) {
                    const row = document.createElement('tr');
                    row.classList.add('hover:bg-indigo-50');
                    row.innerHTML = `
                <td><input type="text" class="border px-1 py-1 w-full state-from rounded"/></td>
                <td><input type="text" class="border px-1 py-1 w-full input-symbol rounded"/></td>
                <td><input type="text" class="border px-1 py-1 w-full state-to rounded"/></td>
                <td>
                    <button type="button" class="addRow bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">+</button>
                    <button type="button" class="removeRow bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 ml-1">×</button>
                </td>`;
                    tableBody.appendChild(row);
                }
                if (e.target.classList.contains('removeRow')) {
                    e.target.closest('tr').remove();
                }
            });

            // ارسال جدول
            generateBtn.addEventListener('click', async () => {
                hideErrors();
                const validation = validateAutomaton();

                if (!validation.valid) {
                    showErrors(validation.errors);
                    return;
                }

                const { transitions, allStates, startState, acceptStates } = validation;
                const automatonJSON = {
                    states: allStates,
                    alphabet: [...new Set(Object.values(transitions).flatMap(t => Object.keys(t)))],
                    transitions,
                    start: startState,
                    accept: acceptStates
                };

                const fullMessage = `${currentAutomaton} ${JSON.stringify(automatonJSON)}`;
                input.value = fullMessage;

                input.disabled = true;
                sendBtn.disabled = true;
                generateBtn.disabled = true;

                try {
                    const res = await fetch('{{ route("front.chat.send") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message: fullMessage })
                    });

                    const data = await res.json();

                    if (data.success) {
                        data.messages.forEach(msg => {
                            const html = `
                        <div class="flex ${msg.sender === 'user' ? 'justify-end' : 'justify-start'} items-start gap-4">
                            <div class="${msg.sender === 'user' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'} p-4 rounded-2xl max-w-lg shadow-lg">
                                ${msg.type === 'image' && msg.image ? `<img src="${msg.image}" class="mb-2 max-w-full rounded-lg"/>` : ''}
                                <p>${msg.message}</p>
                                <span class="text-xs ${msg.sender === 'user' ? 'text-indigo-100' : 'text-gray-400'} self-end">
                                    ${new Date(msg.created_at).toLocaleTimeString('fa-IR', { hour: '2-digit', minute: '2-digit' })}
                                </span>
                            </div>
                        </div>`;
                            messages.insertAdjacentHTML('beforeend', html);
                        });
                        messages.scrollTop = messages.scrollHeight;

                        // بررسی خطا در پاسخ بات
                        const lastBotMsg = data.messages.findLast(m => m.sender === 'bot');
                        if (lastBotMsg && isErrorMessage(lastBotMsg.message)) {
                            showErrors([lastBotMsg.message]);
                            return; // فرم باز می‌ماند
                        }

                        // موفقیت: فرم بسته شود
                        hideErrors();
                        automatonForm.classList.add('hidden');

                        // پاک کردن فرم برای استفاده بعدی
                        tableBody.innerHTML = `
                    <tr class="hover:bg-indigo-50">
                        <td><input type="text" class="border px-1 py-1 w-full state-from rounded"/></td>
                        <td><input type="text" class="border px-1 py-1 w-full input-symbol rounded"/></td>
                        <td><input type="text" class="border px-1 py-1 w-full state-to rounded"/></td>
                        <td><button type="button" class="addRow bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">+</button></td>
                    </tr>`;
                        document.getElementById('startState').value = '';
                        document.getElementById('acceptStates').value = '';

                        input.value = '';
                    } else {
                        showErrors(['خطا در پردازش درخواست. لطفاً دوباره تلاش کنید.']);
                    }
                } catch (err) {
                    console.error(err);
                    showErrors(['خطای ارتباط با سرور. اتصال اینترنت خود را بررسی کنید.']);
                } finally {
                    input.disabled = false;
                    sendBtn.disabled = false;
                    generateBtn.disabled = false;
                }
            });




            async function sendMessage() {
                const text = input.value.trim();

                // اگر نه متن و نه فایل وجود دارد، هیچ کاری نکن
                if (!text && !selectedPdf) return;

                // اگر کاربر فقط dfa/nfa نوشت، فرم باز شود (منطق قبلی)
                if (/^(dfa|nfa|regex)$/i.test(text) && !selectedPdf) {
                    currentAutomaton = text.toLowerCase();
                    formTitle.textContent = currentAutomaton.toUpperCase() + ' - جدول انتقال';
                    automatonForm.classList.remove('hidden');
                    hideErrors();
                    input.value = '';
                    return;
                }

                input.disabled = true;
                sendBtn.disabled = true;

                try {
                    let res;

                    if (selectedPdf) {
                        // حالت ارسال با فایل PDF
                        const formData = new FormData();
                        formData.append('message', text || ''); // حتی اگر خالی باشد
                        formData.append('pdf', selectedPdf);

                        res = await fetch('{{ route("front.chat.send") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                                // Content-Type را عمداً نمی‌گذاریم تا مرورگر خودش multipart بسازد
                            },
                            body: formData
                        });
                    } else {
                        // حالت فقط متن (JSON)
                        res = await fetch('{{ route("front.chat.send") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ message: text })
                        });
                    }

                    const data = await res.json();

                    if (!res.ok) {
                        throw new Error(data.message || `خطای سرور: ${res.status}`);
                    }

                    if (data.success) {
                        data.messages.forEach(msg => {
                            const html = `
                    <div class="flex ${msg.sender === 'user' ? 'justify-end' : 'justify-start'} items-start gap-4">
                        <div class="${msg.sender === 'user' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'} p-4 rounded-2xl max-w-lg shadow-lg">
                            ${msg.type === 'image' && msg.image ? `<img src="${msg.image}" class="mb-2 max-w-full rounded-lg"/>` : ''}
                            <p>${msg.message}</p>
                        </div>
                    </div>`;
                            messages.insertAdjacentHTML('beforeend', html);
                        });
                        messages.scrollTop = messages.scrollHeight;
                        input.value = '';

                        // پاک کردن فایل انتخاب‌شده بعد از ارسال موفق
                        selectedPdf = null;
                        selectedFileName.classList.add('hidden');
                        pdfInput.value = '';
                    } else {
                        alert(data.message || 'خطا در پردازش درخواست');
                    }
                } catch (err) {
                    console.error('خطا در ارسال پیام:', err);
                    alert('خطا در ارتباط با سرور: ' + err.message);
                } finally {
                    input.disabled = false;
                    sendBtn.disabled = false;
                }
            }





           /* async function sendMessage() {
                const text = input.value.trim();

                // اگر نه متن و نه فایل وجود دارد، هیچ کاری نکن
                if (!text && !selectedPdf) return;

                // اگر کاربر فقط dfa/nfa نوشت، فرم باز شود (منطق قبلی)
                if (/^(dfa|nfa)$/i.test(text)) {
                    currentAutomaton = text.toLowerCase();
                    formTitle.textContent = currentAutomaton.toUpperCase() + ' - جدول انتقال';
                    automatonForm.classList.remove('hidden');
                    hideErrors();
                    input.value = '';
                    return;
                }

                input.disabled = true;
                sendBtn.disabled = true;

                try {
                    let res;

                    if (selectedPdf) {
                        // حالت جدید: ارسال با فایل PDF
                        const formData = new FormData();
                        formData.append('message', text);
                        formData.append('pdf', selectedPdf);

                        res = await fetch('{{ route("front.chat.send") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                // Content-Type را عمداً نمی‌گذاریم
                            },
                            body: formData
                        });
                    } else {
                        // حالت قبلی: فقط متن (JSON)
                        res = await fetch('{{ route("front.chat.send") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ message: text })
                        });
                    }

                    const data = await res.json();

                    if (data.success) {
                        data.messages.forEach(msg => {
                            const html = `
                    <div class="flex ${msg.sender === 'user' ? 'justify-end' : 'justify-start'} items-start gap-4">
                        <div class="${msg.sender === 'user' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'} p-4 rounded-2xl max-w-lg shadow-lg">
                            ${msg.type === 'image' && msg.image ? `<img src="${msg.image}" class="mb-2 max-w-full rounded-lg"/>` : ''}
                            <p>${msg.message}</p>
                        </div>
                    </div>`;
                            messages.insertAdjacentHTML('beforeend', html);
                        });
                        messages.scrollTop = messages.scrollHeight;
                        input.value = '';

                        // پاک کردن فایل انتخاب‌شده بعد از ارسال موفق
                        selectedPdf = null;
                        selectedFileName.classList.add('hidden');
                        pdfInput.value = '';
                    }
                } catch (err) {
                    console.error(err);
                } finally {
                    input.disabled = false;
                    sendBtn.disabled = false;
                }
            }*/







            // ارسال پیام معمولی
           /* async function sendMessage() {
                const text = input.value.trim();
                if (!text) return;

                // اگر کاربر فقط dfa/nfa نوشت، فرم باز شود
                if (/^(dfa|nfa)$/i.test(text)) {
                    currentAutomaton = text.toLowerCase();
                    formTitle.textContent = currentAutomaton.toUpperCase() + ' - جدول انتقال';
                    automatonForm.classList.remove('hidden');
                    hideErrors();
                    input.value = '';
                    return;
                }

                input.disabled = true;
                sendBtn.disabled = true;

                try {
                    const res = await fetch('{{ route("front.chat.send") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message: text })
                    });

                    const data = await res.json();

                    if (data.success) {
                        data.messages.forEach(msg => {
                            const html = `
                        <div class="flex ${msg.sender === 'user' ? 'justify-end' : 'justify-start'} items-start gap-4">
                            <div class="${msg.sender === 'user' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'} p-4 rounded-2xl max-w-lg shadow-lg">
                                ${msg.type === 'image' && msg.image ? `<img src="${msg.image}" class="mb-2 max-w-full rounded-lg"/>` : ''}
                                <p>${msg.message}</p>
                            </div>
                        </div>`;
                            messages.insertAdjacentHTML('beforeend', html);
                        });
                        messages.scrollTop = messages.scrollHeight;
                        input.value = '';
                    }
                } catch (err) {
                    console.error(err);
                } finally {
                    input.disabled = false;
                    sendBtn.disabled = false;
                }
            }*/

            sendBtn.addEventListener('click', sendMessage);
            input.addEventListener('keydown', e => {
                if (e.key === 'Enter') sendMessage();
            });
        });
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        function filterChats(category) {
            fetch(`/chat/filter/${category}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const box = document.getElementById('messages');
                        box.innerHTML = '';

                        data.messages.forEach(msg => {
                            const div = document.createElement('div');
                            div.className = msg.sender === 'user'
                                ? 'text-right my-2'
                                : 'text-left my-2';

                            div.innerHTML = `
                        <div class="${msg.sender === 'user' ? 'bg-blue-500 text-white' : 'bg-gray-200'}
                        p-3 rounded-lg inline-block max-w-[70%]">
                            ${msg.message}
                            ${msg.image ? `<img src="data:image/png;base64,${msg.image}" class="mt-2 rounded"/>` : ''}
                        </div>
                    `;
                            box.appendChild(div);
                        });

                        toggleSidebar();
                    }
                });
        }

    </script>
@endsection
