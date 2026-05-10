<?php
require_once __DIR__ . '/includes/config.php';
$page_title = 'FAQ';
$page_description = 'Answers to common questions about SustainLife Foundation — what we do, how we work, and how to partner with us.';
$page_heading = 'Frequently Asked Questions';
$page_crumb = 'FAQ';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/navbar.php';
include __DIR__ . '/partials/page-header.php';

$faqs = [
  ['q'=>'What does SustainLife Foundation do?', 'a'=>'SLF is a Tanzanian NGO promoting healthy, safe and sustainable communities through health, environment, safety, sustainable agriculture and inclusive empowerment programs.'],
  ['q'=>'Where do you operate?', 'a'=>'We operate across communities in Tanzania, partnering with local and national stakeholders.'],
  ['q'=>'Who are your beneficiaries?', 'a'=>'Primarily women, youth and marginalized populations, alongside community-wide programs reaching over a million people indirectly.'],
  ['q'=>'How can I partner with SLF?', 'a'=>'Reach out via our Contact page or request a quote — we partner on consultancy, programs, research and joint initiatives.'],
  ['q'=>'Do you provide consultancy services?', 'a'=>'Yes. Through our consultancy arm we provide professional consultancy and non-consultancy services in agriculture, sustainability and community development.'],
  ['q'=>'How can I support your work?', 'a'=>'You can support us through partnerships, donations, in-kind support or by joining as a volunteer or collaborator. Contact us to learn more.'],
];
?>

<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 mx-auto">
        <div class="accordion" id="faqAcc">
          <?php foreach ($faqs as $i=>$f): ?>
            <div class="accordion-item mb-2 border rounded-3 overflow-hidden">
              <h2 class="accordion-header">
                <button class="accordion-button <?= $i? 'collapsed':'' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#q<?= $i ?>">
                  <?= e($f['q']) ?>
                </button>
              </h2>
              <div id="q<?= $i ?>" class="accordion-collapse collapse <?= $i? '':'show' ?>" data-bs-parent="#faqAcc">
                <div class="accordion-body text-muted"><?= e($f['a']) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
