@extends('layouts.app')

@section('title', 'Visi & Misi — SDN Rejosari 03')

@push('styles')
<style>
    .vm-header {
        background: linear-gradient(135deg, var(--site-red) 0%, var(--site-red-dark) 100%);
        color: #ffffff;
        padding: 40px 30px;
        border-radius: 16px;
        margin-bottom: 30px;
        box-shadow: 0 4px 14px rgba(168, 68, 80, 0.15);
    }

    .vm-header__badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
    }

    .vm-header h1 {
        margin: 0 0 10px;
        font-size: clamp(26px, 3.5vw, 36px);
        line-height: 1.25;
    }

    .vm-header p {
        margin: 0;
        font-size: 16px;
        opacity: 0.95;
        max-width: 650px;
        line-height: 1.6;
    }

    .vm-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 32px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        margin-bottom: 25px;
    }

    .vm-vision-quote {
        background: var(--site-pink);
        border-left: 6px solid var(--site-red);
        padding: 24px 28px;
        border-radius: 10px;
        margin: 20px 0;
    }

    .vm-vision-quote p {
        font-size: 18px;
        font-weight: 700;
        color: var(--site-red-dark);
        margin: 0;
        line-height: 1.5;
        font-style: italic;
    }

    .vm-list {
        list-style: none;
        padding: 0;
        margin: 20px 0 0;
        display: grid;
        gap: 14px;
    }

    .vm-list li {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        font-size: 15px;
        line-height: 1.6;
        color: #334155;
        padding: 14px 18px;
        background: #fbfcfd;
        border: 1px solid #edf2f7;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .vm-list li:hover {
        background: #ffffff;
        border-color: #cbd5e1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .vm-list__number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 50%;
        background: var(--site-red);
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .vm-goals-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .vm-goal-box {
        padding: 22px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #fafbfc;
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .vm-goal-box:hover {
        border-color: var(--site-red);
        transform: translateY(-2px);
    }

    .vm-goal-box h3 {
        margin: 0 0 10px;
        font-size: 16px;
        color: var(--site-red-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .vm-goal-letter {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: var(--site-red);
        color: #ffffff;
        font-weight: 800;
        font-size: 14px;
    }

    .vm-goal-box p {
        margin: 0;
        font-size: 14px;
        color: #64748b;
        line-height: 1.55;
    }

    @media (max-width: 640px) {
        .vm-header {
            padding: 28px 20px;
        }

        .vm-card {
            padding: 22px 18px;
        }

        .vm-vision-quote {
            padding: 18px 20px;
        }

        .vm-vision-quote p {
            font-size: 16px;
        }

        .vm-list li {
            padding: 12px 14px;
            font-size: 14px;
            gap: 12px;
        }

        .vm-goals-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }
    }
</style>
@endpush

@section('content')
<div class="vm-header">
    <span class="vm-header__badge">ARAH & PEDOMAN</span>
    <h1>Visi & Misi SDN Rejosari 03</h1>
    <p>Landasan komitmen kami dalam mewujudkan ekosistem pendidikan yang unggul, berkarakter, dan berdaya saing.</p>
</div>

<div class="vm-card">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
        <h2 style="margin: 0; color: var(--site-text); font-size: 22px;">Visi Sekolah</h2>
        <span style="display: inline-block; background: var(--site-pink); color: var(--site-red-dark); padding: 4px 12px; border-radius: 999px; font-size: 13px; font-weight: 700; letter-spacing: 0.5px;">
            MOTTO: UMBI
        </span>
    </div>

    <div class="vm-vision-quote">
        <p>“SD Negeri Rejosari 03 UMBI (Unggul Budi Pekerti, Maju dalam Bidang IPTEK, Berkarakter, dan Inovatif)”</p>
    </div>

    <p style="color: #64748b; font-size: 14px; margin: 0; line-height: 1.6;">
        Visi ini menjadi kompas bagi seluruh warga SDN Rejosari 03 dalam merancang proses pembelajaran holistik, mengutamakan pembentukan budi pekerti luhur di samping capaian literasi, teknologi, dan inovasi peserta didik.
    </p>
</div>

<div class="vm-card">
    <h2 style="margin: 0; color: var(--site-text); font-size: 22px;">Misi Sekolah</h2>
    <ul class="vm-list">
        <li>
            <span class="vm-list__number">1</span>
            <div>
                Membangun karakteristik peserta didik yang Taqwa Terhadap Tuhan Yang Maha Esa secara mandiri melalui rutinitas kegiatan keagamaan dan menerapkan ajaran agama melalui cara berinteraksi dengan manusia.
            </div>
        </li>
        <li>
            <span class="vm-list__number">2</span>
            <div>
                Melayani dengan penuh tanggung jawab guna membentuk peserta didik yang berbudi pekerti luhur dalam perkataan dan perbuatan.
            </div>
        </li>
        <li>
            <span class="vm-list__number">3</span>
            <div>
                Mengembangkan program pembelajaran berbasis IT yang terintegrasi dengan Literasi dan Numerasi.
            </div>
        </li>
        <li>
            <span class="vm-list__number">4</span>
            <div>
                Menciptakan kegiatan belajar yang menarik dengan berbasis IT secara kontinu melalui kelas digital.
            </div>
        </li>
        <li>
            <span class="vm-list__number">5</span>
            <div>
                Membangun lingkungan sekolah yang membentuk peserta didik memiliki akhlak mulia terhadap lingkungan hidup di sekolah dengan kegiatan pembiasaan.
            </div>
        </li>
        <li>
            <span class="vm-list__number">6</span>
            <div>
                Membangun lingkungan sekolah yang bertoleransi dalam kebhinekaan global, mencintai budaya lokal dan menjunjung nilai gotong royong.
            </div>
        </li>
        <li>
            <span class="vm-list__number">7</span>
            <div>
                Mengembangkan kemandirian, nalar kritis dan kreativitas yang memfasilitasi keragaman minat dan bakat peserta didik.
            </div>
        </li>
        <li>
            <span class="vm-list__number">8</span>
            <div>
                Mengembangkan program sekolah yang membentuk ide dan gagasan cepat tanggap terhadap perubahan yang terjadi untuk merancang inovasi.
            </div>
        </li>
        <li>
            <span class="vm-list__number">9</span>
            <div>
                Mengembangkan dan memfasilitasi peningkatan prestasi peserta didik sesuai minat dan bakatnya melalui proses pendampingan dan kerja sama dengan orang tua.
            </div>
        </li>
    </ul>
</div>

<div class="vm-card">
    <h2 style="margin: 0 0 6px; color: var(--site-text); font-size: 22px;">Nilai Utama UMBI</h2>
    <p style="margin: 0 0 16px; font-size: 14px; color: #64748b;">Empat pilar nilai yang menjiwai seluruh kegiatan belajar-mengajar dan budaya sekolah di SDN Rejosari 03 Semarang.</p>

    <div class="vm-goals-grid">
        <div class="vm-goal-box">
            <h3><span class="vm-goal-letter">U</span> Unggul Budi Pekerti</h3>
            <p>Membentuk peserta didik yang taat beribadah, berbudi pekerti luhur dalam ucapan dan perbuatan, serta berakhlak mulia terhadap sesama.</p>
        </div>
        <div class="vm-goal-box">
            <h3><span class="vm-goal-letter">M</span> Maju dalam IPTEK</h3>
            <p>Mengintegrasikan teknologi informasi dalam pembelajaran literasi dan numerasi serta kelas digital secara kontinu dan adaptif.</p>
        </div>
        <div class="vm-goal-box">
            <h3><span class="vm-goal-letter">B</span> Berkarakter</h3>
            <p>Menumbuhkan kemandirian, nalar kritis, toleransi dalam kebhinekaan global, dan semangat gotong royong serta mencintai budaya lokal.</p>
        </div>
        <div class="vm-goal-box">
            <h3><span class="vm-goal-letter">I</span> Inovatif</h3>
            <p>Cepat tanggap terhadap perubahan untuk merancang inovasi dan memfasilitasi peningkatan prestasi bakat serta minat peserta didik.</p>
        </div>
    </div>
</div>
@endsection
