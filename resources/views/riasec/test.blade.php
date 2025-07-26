@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 800px;">
    <div class="card shadow-lg">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary mb-2">EduGuide</h3>
                <p class="text-muted" id="level-info">Anda sedang di Level 1</p>
            </div>

            <div id="progress-bar" class="mb-4">
                
            </div>

            <div id="question-area" class="text-center">
                <div class="d-flex justify-content-center align-items-center" style="min-height: 150px;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted ms-3">Memuat pertanyaan...</p>
                </div>
            </div>

            <div id="alert-message" class="alert mt-4 d-none" role="alert"></div>

            <div class="d-flex justify-content-between mt-4">
                <button id="prev-btn" class="btn btn-secondary" disabled>
                    Sebelumnya
                </button>
                <button id="next-btn" class="btn btn-primary">
                    Selanjutnya
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>

let currentLevel = 1;
let currentQuestionOrderInLevel = 1;
let questionsPerLevel = 12;
let totalQuestionsGlobal = 0;
let userAnswersCache = {};
let currentQuestionId = null;
let currentQuestionServerLevel = null;
let currentQuestionGlobalOrder = null;
let currentQuestionData = null;

let questionArea;
let progressBarContainer;
let prevBtn;
let nextBtn;
let alertMessageDiv;
let levelInfoSpan;

function getJwtToken() {
    const token = localStorage.getItem('jwt_token');
    console.log('DEBUG: Token JWT dari localStorage:', token ? 'Ada' : 'Tidak Ada');
    return token;
}

function showAlert(message, type) {
    if (!alertMessageDiv) return;
    alertMessageDiv.textContent = message;
    alertMessageDiv.className = `alert alert-${type} mt-4`;
    alertMessageDiv.classList.remove('d-none');
    setTimeout(() => alertMessageDiv.classList.add('d-none'), 3000);
    console.log('DEBUG: Alert ditampilkan:', message, type);
}

function updateProgressBar(answeredCount) { 
    console.log('DEBUG: updateProgressBar dipanggil. answeredCount:', answeredCount);
    console.log('DEBUG: userAnswersCache:', userAnswersCache);
    console.log('DEBUG: currentLevel:', currentLevel, 'questionsPerLevel:', questionsPerLevel);
    console.log('DEBUG: currentQuestionGlobalOrder:', currentQuestionGlobalOrder);

    if (!progressBarContainer || !levelInfoSpan) return;

    let percentOverall = totalQuestionsGlobal > 0 ? Math.round((answeredCount / totalQuestionsGlobal) * 100) : 0;
    console.log('DEBUG: percentOverall:', percentOverall);

    let startQuestionOfCurrentLevel = (currentLevel - 1) * questionsPerLevel + 1;
    let endQuestionOfCurrentLevel = currentLevel * questionsPerLevel;
    let answeredInCurrentLevel = 0;

    for (let i = startQuestionOfCurrentLevel; i <= endQuestionOfCurrentLevel; i++) {
        if (userAnswersCache[i]) {
            answeredInCurrentLevel++;
        }
    }

    let percentCurrentLevel = (answeredInCurrentLevel / questionsPerLevel) * 100;
    console.log('DEBUG: answeredInCurrentLevel (for current level):', answeredInCurrentLevel, 'percentCurrentLevel:', percentCurrentLevel);

    progressBarContainer.innerHTML = `
        <div class="mb-2">
            <strong>Progres Keseluruhan:</strong>
            <div class="progress" style="height: 20px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: ${percentOverall}%;" aria-valuenow="${answeredCount}" aria-valuemin="0" aria-valuemax="${totalQuestionsGlobal}">${percentOverall}%</div>
            </div>
        </div>

        
    `;
    levelInfoSpan.textContent = `Anda sedang di Level ${currentLevel}`;
}

async function loadQuestion(levelToLoad = null, orderToLoadInLevel = null) { 
    console.log('DEBUG: loadQuestion dipanggil. Level:', levelToLoad, 'OrderInLevel:', orderToLoadInLevel);
    if (!questionArea) {
        console.error('DEBUG: questionArea belum diinisialisasi!');
        return;
    }

    questionArea.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="min-height: 150px;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted ms-3">Memuat pertanyaan...</p>
        </div>
    `;
    showAlert('', 'd-none');

    const token = getJwtToken();
    if (!token) {
        console.log('DEBUG: Token tidak ada, mengarahkan ke login.');
        showAlert('Sesi Anda berakhir. Silakan login kembali.', 'danger');
        setTimeout(() => window.location.href = '{{ route('login') }}', 2000);
        return;
    }

    try {
        let fetchUrl;

        if (levelToLoad && orderToLoadInLevel) {
            fetchUrl = `/api/riasec-get-question/${levelToLoad}/${orderToLoadInLevel}`;
        } else {
            fetchUrl = `/api/riasec-get-question`;
        }
        console.log('DEBUG: Melakukan fetch ke:', fetchUrl);

        const response = await fetch(fetchUrl, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token
            }
        });

        console.log('DEBUG: Respons diterima. Status:', response.status);
        const data = await response.json();
        console.log('DEBUG: Data respons:', data);

        if (!response.ok) {
            console.error('DEBUG: Respons tidak OK. Data error:', data);
            if (response.status === 403) {
                showAlert(data.error || 'Anda tidak diizinkan mengakses level ini dulu.', 'danger');
                loadQuestion();
                return;
            }
            if (response.status === 404 && data.message && data.message.includes("Pertanyaan tidak ditemukan")) {
                showAlert(data.message, 'warning');
                return;
            }
            if (response.status === 401) {
                throw new Error('Unauthorized. Token invalid or expired.');
            }
            throw new Error(data.message || 'Gagal memuat pertanyaan.');
        }

        if (data.test_completed) {
            console.log('DEBUG: Tes selesai.');
            questionArea.innerHTML = `
                <div class="alert alert-success text-center fs-4" role="alert">
                    Tes Anda sudah selesai! Mengarahkan Anda ke halaman hasil...
                </div>
            `;
            showAlert(data.message, 'success');
            if (prevBtn) prevBtn.disabled = true;
            if (nextBtn) nextBtn.disabled = true;
            setTimeout(() => {
                window.location.href = '{{ route('riasec.result') }}';
            }, 2000);
            return;
        }

        currentLevel = data.current_level;
        currentQuestionOrderInLevel = data.current_question_order_in_level;
        currentQuestionGlobalOrder = data.current_question_order;
        totalQuestionsGlobal = data.total_questions;
        questionsPerLevel = data.questions_per_level;
        currentQuestionData = data.question;
        currentQuestionId = data.question.id;
        currentQuestionServerLevel = data.question.level;


        let selectedChoiceToMark = userAnswersCache[currentQuestionGlobalOrder] || data.user_answer_choice;
        if (selectedChoiceToMark) {
            userAnswersCache[currentQuestionGlobalOrder] = selectedChoiceToMark;
        } else {
            delete userAnswersCache[currentQuestionGlobalOrder];
        }

        questionArea.innerHTML = `
            <h6 class="mb-3 text-secondary">Pertanyaan ${currentQuestionOrderInLevel} dari ${questionsPerLevel} (Level ${currentLevel})</h6>
            <h5 class="mb-4 fw-bold text-dark">${currentQuestionData.question_text}</h5>
            <div class="d-grid gap-2" id="options-container">
                <button type="button" class="btn btn-outline-primary btn-lg py-3 option-btn" data-choice="R">${currentQuestionData.option_r}</button>
                <button type="button" class="btn btn-outline-primary btn-lg py-3 option-btn" data-choice="I">${currentQuestionData.option_i}</button>
                <button type="button" class="btn btn-outline-primary btn-lg py-3 option-btn" data-choice="A">${currentQuestionData.option_a}</button>
                <button type="button" class="btn btn-outline-primary btn-lg py-3 option-btn" data-choice="S">${currentQuestionData.option_s}</button>
                <button type="button" class="btn btn-outline-primary btn-lg py-3 option-btn" data-choice="E">${currentQuestionData.option_e}</button>
                <button type="button" class="btn btn-outline-primary btn-lg py-3 option-btn" data-choice="C">${currentQuestionData.option_c}</button>
            </div>
        `;

        if (selectedChoiceToMark) {
            const selectedButton = document.querySelector(`.option-btn[data-choice="${selectedChoiceToMark}"]`);
            if (selectedButton) {
                selectedButton.classList.remove('btn-outline-primary');
                selectedButton.classList.add('btn-primary');
                selectedButton.setAttribute('data-selected', 'true');
            }
        }

        updateProgressBar(data.answered_count);

        if (prevBtn) prevBtn.disabled = (currentQuestionGlobalOrder === 1);
        if (nextBtn) nextBtn.innerText = (currentQuestionGlobalOrder === totalQuestionsGlobal) ? 'Selesai' : 'Selanjutnya';
        
        if (nextBtn && !selectedChoiceToMark && currentQuestionGlobalOrder < totalQuestionsGlobal) {
             nextBtn.disabled = true;
        } else if (nextBtn) {
             nextBtn.disabled = false;
        }

        document.querySelectorAll('.option-btn').forEach(button => {
            button.addEventListener('click', handleOptionClick);
        });

    } catch (error) {
        console.error('DEBUG: Error saat loadQuestion:', error);
        questionArea.innerHTML = `
            <div class="alert alert-danger" role="alert">
                Gagal memuat pertanyaan: ${error.message}. Silakan coba refresh halaman.
            </div>
        `;
        showAlert(error.message, 'danger');
        if (error.message.includes('Unauthorized') || error.message.includes('Token')) {
             setTimeout(() => window.location.href = '{{ route('login') }}', 2000);
        }
    }
}

async function handleOptionClick(event) {
    const selectedChoice = event.target.dataset.choice;
    const optionButtons = document.querySelectorAll('.option-btn');

    optionButtons.forEach(btn => {
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-outline-primary');
        btn.removeAttribute('data-selected');
    });
    event.target.classList.remove('btn-outline-primary');
    event.target.classList.add('btn-primary');
    event.target.setAttribute('data-selected', 'true');

    userAnswersCache[currentQuestionGlobalOrder] = selectedChoice;

    if (nextBtn) nextBtn.disabled = false;

    await saveAnswerToBackend(selectedChoice);
}

async function saveAnswerToBackend(selectedChoice) {
    console.log('DEBUG: saveAnswerToBackend dipanggil.');
    const token = getJwtToken();
    if (!token) {
        console.log('DEBUG: Token tidak ada saat menyimpan jawaban.');
        showAlert('Sesi berakhir. Silakan login kembali.', 'danger');
        setTimeout(() => window.location.href = '{{ route('login') }}', 2000);
        return false;
    }

    try {
        console.log('DEBUG: Mengirim jawaban untuk Question ID:', currentQuestionId, 'Level:', currentQuestionServerLevel, 'Order Global:', currentQuestionGlobalOrder, 'Choice:', selectedChoice);
        const response = await fetch('/api/riasec-submit-answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: JSON.stringify({
                question_id: currentQuestionId,
                level: currentQuestionServerLevel,
                question_order: currentQuestionGlobalOrder,
                answer_choice: selectedChoice
            })
        });

        console.log('DEBUG: Respons submitAnswer. Status:', response.status);
        const data = await response.json();
        console.log('DEBUG: Data submitAnswer:', data);

        if (!response.ok) {
            console.error('DEBUG: submitAnswer respons tidak OK. Data error:', data);
            throw new Error(data.message || 'Gagal menyimpan jawaban.');
        }

        updateProgressBar(data.answered_count);
        showAlert(data.message, 'success');

        if (data.level_completed) {
            console.log('DEBUG: Level selesai. Mengarahkan ke level berikutnya:', data.next_level);
            showAlert(`Selamat! Anda telah menyelesaikan Level ${currentLevel}. Silakan lanjut ke Level ${data.next_level}.`, 'info');
        }

        return true;

    } catch (error) {
        console.error('DEBUG: Error saat saveAnswerToBackend:', error);
        showAlert('Terjadi kesalahan saat menyimpan jawaban: ' + error.message, 'danger');
        if (error.message.includes('Unauthorized') || error.message.includes('Token')) {
             setTimeout(() => window.location.href = '{{ route('login') }}', 2000);
        }
        return false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('DEBUG: DOMContentLoaded fired.');

    questionArea = document.getElementById('question-area');
    progressBarContainer = document.getElementById('progress-bar');
    prevBtn = document.getElementById('prev-btn');
    nextBtn = document.getElementById('next-btn');
    alertMessageDiv = document.getElementById('alert-message');
    levelInfoSpan = document.getElementById('level-info');

    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            console.log('DEBUG: Prev button clicked.');
            if (currentQuestionOrderInLevel > 1) {
                currentQuestionOrderInLevel--;
                loadQuestion(currentLevel, currentQuestionOrderInLevel);
            } else if (currentLevel > 1) {
                currentLevel--;
                currentQuestionOrderInLevel = questionsPerLevel;
                loadQuestion(currentLevel, currentQuestionOrderInLevel);
            }
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', async function() {
            console.log('DEBUG: Next button clicked.');
            const selected = document.querySelector('.option-btn[data-selected="true"]')?.dataset.choice;

            if (!selected) {
                console.log('DEBUG: Opsi belum dipilih saat klik Next.');
                showAlert('Silakan pilih salah satu jawaban sebelum melanjutkan.', 'warning');
                return;
            }

            const isSaved = await saveAnswerToBackend(selected);

            if (isSaved) {
                if (currentQuestionGlobalOrder < totalQuestionsGlobal) {
                    if (currentQuestionOrderInLevel < questionsPerLevel) {
                        currentQuestionOrderInLevel++;
                        loadQuestion(currentLevel, currentQuestionOrderInLevel);
                        console.log('DEBUG: Lanjut ke pertanyaan berikutnya di level yang sama.');
                    } else if (currentLevel < 3) {
                        currentLevel++;
                        currentQuestionOrderInLevel = 1;
                        loadQuestion(currentLevel, currentQuestionOrderInLevel);
                        console.log('DEBUG: Pindah ke level berikutnya.');
                    } else {
                        console.log('DEBUG: Selesai tes (dari next button).');
                        window.location.href = '{{ route('riasec.result') }}';
                    }
                } else {
                    console.log('DEBUG: Selesai tes (dari next button, total pertanyaan habis).');
                    window.location.href = '{{ route('riasec.result') }}';
                }
            }
        });
    }

    loadQuestion();
});
</script>
@endpush