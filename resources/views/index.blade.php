<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Smart Medicine Assistant – Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/p1.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> --}}
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy shadow-sm sticky-top main-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}">
                <i class="bi bi-capsule me-2"></i>
                <span class="logo-text">
                    <span class="logo-aa">AA</span>-MED
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
                aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                            href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}"
                            href="{{ route('search') }}">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('suggestion') ? 'active' : '' }}"
                            href="{{ route('suggestion') }}">Suggestion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center justify-content-center hero-row">
                <!-- Left text -->
                <div class="col-lg-6 mb-4">
                    <h1 class="hero-title">
                        Your trusted<br>
                        <span>medicine guide.</span>
                    </h1>
                    <p class="hero-sub">
                        Understand your medicine, improve your health. Simple, clear information for everyday people.
                    </p>
                    <a href="{{ route('search') }}" class="btn hero-btn px-5 py-3">
                        <i class="bi bi-search me-2"></i> Search Medicines
                    </a>
                </div>
                <div class="col-lg-5 text-center">
                    <img src="{{ asset('images/Doctor.png') }}" alt="Doctor" class="hero-img img-fluid">
                </div>
            </div>
        </div>
    </header>

    <!-- TIPS -->
    <section class="section-padding">
        <div class="container">
            <h2 class="section-title text-center">Get Strong, Stay Smart</h2>
            <p class="section-subtitle text-center mb-5">
                Small daily habits that support your medicine and make healthy living easier.
            </p>

            <div class="row g-4">
                <div class="col-sm-6 col-lg-4">
                    <div class="tip-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <span class="tip-icon"><i class="bi bi-bicycle"></i></span>
                            <div>
                                <div class="fw-semibold">Start Working Out</div>
                                <small class="text-muted">Begin with short walks and light movement to support your
                                    treatment.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="tip-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <span class="tip-icon"><i class="bi bi-alarm"></i></span>
                            <div>
                                <div class="fw-semibold">Eat slowly, feel fuller</div>
                                <small class="text-muted">Chew well and give your body time to feel satisfied.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="tip-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <span class="tip-icon"><i class="bi bi-clipboard2-check"></i></span>
                            <div>
                                <div class="fw-semibold">Follow your plan</div>
                                <small class="text-muted">Set simple, realistic goals for exercise and
                                    medication.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="tip-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <span class="tip-icon"><i class="bi bi-egg-fried"></i></span>
                            <div>
                                <div class="fw-semibold">Add more protein</div>
                                <small class="text-muted">Eggs, chicken, beans and lentils help you stay full
                                    longer.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="tip-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <span class="tip-icon"><i class="bi bi-cup-straw"></i></span>
                            <div>
                                <div class="fw-semibold">Drink water before meals</div>
                                <small class="text-muted">One glass before eating supports digestion and helps control
                                    appetite.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="tip-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <span class="tip-icon"><i class="bi bi-droplet-half"></i></span>
                            <div>
                                <div class="fw-semibold">Watch sugary drinks</div>
                                <small class="text-muted">Whole fruit is better than juice: more fiber, less hidden
                                    sugar.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="tip-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <span class="tip-icon"><i class="bi bi-emoji-sunglasses"></i></span>
                            <div>
                                <div class="fw-semibold">Move your whole body</div>
                                <small class="text-muted">Ab workouts alone don’t burn belly fat; overall activity
                                    does.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 mx-auto">
                    <div class="tip-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <span class="tip-icon"><i class="bi bi-person-walking"></i></span>
                            <div>
                                <div class="fw-semibold">Walk after meals</div>
                                <small class="text-muted">10 minutes of walking after eating supports digestion and
                                    blood
                                    sugar.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="tip-card h-100">
                        <div class="d-flex align-items-start gap-3">
                            <span class="tip-icon"><i class="bi bi-moon-stars"></i></span>
                            <div>
                                <div class="fw-semibold">Protect your sleep</div>
                                <small class="text-muted">Good sleep makes it easier to control cravings and follow
                                    your
                                    plan.</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- POPULAR MEDICINES -->
    <section class="section-padding section-soft">
        <div class="container">
            <h3 class="section-title text-center">Popular Medicines</h3>
            <p class="section-subtitle text-center mb-5">
                Frequently searched medicines, their main use, and whether they require a prescription.
            </p>

            <div class="row g-4 justify-content-center">
                <div class="col-md-6">
                    <div class="med-card h-100">
                        <div class="d-flex align-items-center mb-1">
                            <span class="med-icon me-2"><i class="bi bi-capsule"></i></span>
                            <span class="fw-semibold">Paracetamol</span>
                        </div>
                        <small class="text-muted d-block mb-1">Pain relief &amp; fever reducer.</small>
                        <small class="badge bg-light text-success">Prescription: Not required (OTC)</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="med-card h-100">
                        <div class="d-flex align-items-center mb-1">
                            <span class="med-icon me-2"><i class="bi bi-capsule"></i></span>
                            <span class="fw-semibold">Ibuprofen</span>
                        </div>
                        <small class="text-muted d-block mb-1">Anti-inflammatory &amp; pain relief.</small>
                        <small class="badge bg-light text-success">Prescription: Not required (OTC)</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="med-card h-100">
                        <div class="d-flex align-items-center mb-1">
                            <span class="med-icon me-2"><i class="bi bi-capsule"></i></span>
                            <span class="fw-semibold">Amoxicillin</span>
                        </div>
                        <small class="text-muted d-block mb-1">Antibiotic for bacterial infections.</small>
                        <small class="badge bg-light text-danger">Prescription: Required</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="med-card h-100">
                        <div class="d-flex align-items-center mb-1">
                            <span class="med-icon me-2"><i class="bi bi-capsule"></i></span>
                            <span class="fw-semibold">Loratadine</span>
                        </div>
                        <small class="text-muted d-block mb-1">Relief for seasonal allergies.</small>
                        <small class="badge bg-light text-success">Prescription: Not required (OTC)</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section-padding">
        <div class="container">
            <h3 class="section-title text-center mb-3">FAQ</h3>
            <p class="section-subtitle text-center mb-4">
                Quick answers to common questions about using Smart Medicine Assistant.
            </p>
            <div class="faq-wrapper mx-auto">
                <div class="accordion" id="faq">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a1" aria-expanded="true" aria-controls="a1">
                                <span class="faq-icon"><i class="bi bi-question-lg"></i></span>
                                <span>How can I search for a medicine?</span>
                            </button>
                        </h2>
                        <div id="a1" class="accordion-collapse collapse show" data-bs-parent="#faq">
                            <div class="accordion-body">
                                Click the “Search Medicines” button at the top and type the name of the medicine you’re
                                looking for.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a2" aria-controls="a2">
                                <span class="faq-icon"><i class="bi bi-question-lg"></i></span>
                                <span>Can I suggest a new medicine?</span>
                            </button>
                        </h2>
                        <div id="a2" class="accordion-collapse collapse" data-bs-parent="#faq">
                            <div class="accordion-body">
                                Yes. Use the “Suggest Medicine” page to send us the name and details. We’ll review it
                                and
                                add it as soon as possible.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a3" aria-controls="a3">
                                <span class="faq-icon"><i class="bi bi-question-lg"></i></span>
                                <span>Are the details medically verified?</span>
                            </button>
                        </h2>
                        <div id="a3" class="accordion-collapse collapse" data-bs-parent="#faq">
                            <div class="accordion-body">
                                Information is collected from trusted references and reviewed by pharmacy students under
                                supervision.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a4" aria-controls="a4">
                                <span class="faq-icon"><i class="bi bi-question-lg"></i></span>
                                <span>Do you store my personal data?</span>
                            </button>
                        </h2>
                        <div id="a4" class="accordion-collapse collapse" data-bs-parent="#faq">
                            <div class="accordion-body">
                                You can search without any personal data. Suggestions are stored only to improve content
                                and fix issues.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#a5" aria-controls="a5">
                                <span class="faq-icon"><i class="bi bi-question-lg"></i></span>
                                <span>What if I can’t find a medicine?</span>
                            </button>
                        </h2>
                        <div id="a5" class="accordion-collapse collapse" data-bs-parent="#faq">
                            <div class="accordion-body">
                                If a medicine is missing, you can request it from the “Suggest Medicine” page and we’ll
                                add it soon.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- FOOTER -->
    <footer class="main-footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="small">© 2025 Smart Medicine Assistant. All rights reserved.</div>
            <div class="d-flex align-items-center gap-4 footer-links">
                <a class="small text-decoration-none" href="#">Privacy</a>
                <a class="small text-decoration-none" href="#">Terms</a>
                <a class="small text-decoration-none" href="#">Contact</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
