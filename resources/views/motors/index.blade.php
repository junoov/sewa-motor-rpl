@extends('layouts.app')

@section('title', 'Cari Motor - MotoRent')

@section('pageHeader')
<div class="motor-page-desktop-header">
  @include('partials.site-header')
</div>

<header class="motor-mobile-topbar">
  <div class="motor-mobile-topbar__inner">
    <a href="{{ route('home') }}" class="motor-mobile-topbar__back" aria-label="Kembali ke beranda">
      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 18 9 12l6-6"/></svg>
    </a>
    <div class="motor-mobile-topbar__title">{{ $mobileTitle ?? 'Cari Motor' }}</div>
    <button type="button" class="motor-mobile-topbar__filter" data-mobile-filter-open>
      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16"/><path d="M7 12h10"/><path d="M10 17h4"/></svg>
      <span>Filter</span>
    </button>
  </div>
</header>
@endsection

@push('head')
<style>
  .motor-page-desktop-header {
    display: block;
  }

  .motor-mobile-topbar,
  .motor-sidebar-mobile-head,
  .motor-mobile-filter-backdrop {
    display: none;
  }

  .motor-mobile-topbar {
    position: sticky;
    top: 0;
    z-index: 50;
    width: calc(100% - 20px);
    margin: 28px auto 0;
    background: #ffffff;
    border-bottom: 1px solid #eef2f8;
  }

  .motor-mobile-topbar__inner {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 12px 16px;
    height: 64px;
  }

  .motor-mobile-topbar__back,
  .motor-mobile-topbar__filter {
    display: grid;
    place-items: center;
    width: 40px;
    height: 40px;
    border: 0;
    border-radius: 50%;
    background: #f4f6f9;
    color: #111827;
    text-decoration: none;
    cursor: pointer;
    flex-shrink: 0;
  }

  .motor-mobile-topbar__back {
    position: absolute;
    left: 16px;
    top: 12px;
  }

  .motor-mobile-topbar__back svg,
  .motor-mobile-topbar__filter svg {
    width: 20px;
    height: 20px;
    fill: none;
    stroke: currentColor;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .motor-mobile-topbar__title {
    position: absolute;
    left: 104px;
    right: 104px;
    top: 50%;
    transform: translateY(-50%);
    flex: none;
    text-align: center;
    font-size: 16px;
    font-weight: 900;
    color: #111827;
    letter-spacing: -0.3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .motor-mobile-topbar__filter {
    position: absolute;
    right: 16px;
    top: 12px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    width: auto;
    padding: 0 12px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 800;
  }

  .motor-mobile-topbar__filter svg {
    flex-shrink: 0;
  }

  .motor-search-page {
    width: min(calc(100% - clamp(24px, 4vw, 72px)), 1660px);
    margin: 0 auto;
    padding: 26px 0 44px;
  }

  .motor-search-shell {
    background: transparent;
  }

  .motor-search-head {
    padding: 22px 0 24px;
    background: transparent;
  }

  .motor-search-head h1 {
    margin: 0;
    font-size: 3.28rem;
    line-height: 1.04;
    letter-spacing: -0.04em;
    color: #101a32;
    font-weight: 900;
  }

  .motor-search-head p {
    margin: 13px 0 0;
    max-width: 58ch;
    color: #5f6f88;
    font-size: 1.02rem;
    line-height: 1.65;
    font-weight: 500;
  }

  .motor-search-layout {
    display: grid;
    grid-template-columns: 278px minmax(0, 1fr);
    gap: 36px;
    align-items: start;
  }

  .motor-search-sidebar {
    align-self: start;
    border: 1px solid #e6edf6;
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 14px 34px rgba(20, 42, 78, 0.05);
    padding: 16px 14px 18px;
  }

  .motor-filter-section + .motor-filter-section {
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid #eef2f8;
  }

  .motor-filter-title {
    margin: 0 0 12px;
    color: #15203a;
    font-size: 1rem;
    font-weight: 800;
  }

  .motor-type-list {
    display: grid;
    gap: 8px;
  }

  .motor-type-button {
    width: 100%;
    min-height: 44px;
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 0 14px;
    border: 1px solid #e1e8f3;
    border-radius: 12px;
    background: #ffffff;
    color: #485973;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
  }

  .motor-type-button:hover,
  .motor-type-button.is-active {
    color: #075cff;
    border-color: #7ea6ff;
    box-shadow: 0 0 0 2px rgba(7, 92, 255, 0.12);
  }

  .motor-type-button svg {
    width: 20px;
    height: 20px;
    color: currentColor;
  }

  .motor-range-values {
    margin-bottom: 10px;
    color: #075cff;
    font-size: 0.95rem;
    font-weight: 800;
  }

  .motor-range-wrap {
    position: relative;
    height: 28px;
  }

  .motor-range-track,
  .motor-range-progress {
    position: absolute;
    left: 0;
    right: 0;
    top: 12px;
    height: 4px;
    border-radius: 999px;
  }

  .motor-range-track {
    background: #dfe8f8;
  }

  .motor-range-progress {
    background: linear-gradient(90deg, #0f61ff 0%, #2f84ff 100%);
  }

  .motor-range-wrap input[type="range"] {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 28px;
    margin: 0;
    pointer-events: none;
    background: none;
    appearance: none;
  }

  .motor-range-wrap input[type="range"]::-webkit-slider-thumb {
    pointer-events: auto;
    width: 18px;
    height: 18px;
    border: 3px solid #0f61ff;
    border-radius: 50%;
    background: #ffffff;
    box-shadow: 0 6px 18px rgba(15, 97, 255, 0.24);
    appearance: none;
    cursor: pointer;
  }

  .motor-range-wrap input[type="range"]::-moz-range-thumb {
    pointer-events: auto;
    width: 18px;
    height: 18px;
    border: 3px solid #0f61ff;
    border-radius: 50%;
    background: #ffffff;
    box-shadow: 0 6px 18px rgba(15, 97, 255, 0.24);
    cursor: pointer;
  }

  .motor-check-group {
    display: grid;
    gap: 8px;
  }

  .motor-check-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #4c5e78;
    font-size: 0.93rem;
    font-weight: 500;
    cursor: pointer;
  }

  .motor-check-item input {
    width: 16px;
    height: 16px;
    border-radius: 4px;
    accent-color: #075cff;
  }

  .motor-filter-actions {
    display: none;
  }

  .motor-apply-btn,
  .motor-reset-btn,
  .motor-search-submit,
  .motor-card-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    font-weight: 800;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, border-color 0.2s ease;
  }

  .motor-apply-btn,
  .motor-search-submit,
  .motor-card-button {
    border: 0;
    color: #ffffff;
    background: linear-gradient(180deg, #1c71ff 0%, #075cff 100%);
    box-shadow: 0 18px 36px rgba(7, 92, 255, 0.22);
  }

  .motor-apply-btn:hover,
  .motor-search-submit:hover,
  .motor-card-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 20px 42px rgba(7, 92, 255, 0.28);
  }

  .motor-apply-btn {
    min-height: 48px;
  }

  .motor-reset-btn {
    min-height: 46px;
    border: 1px solid #dfe7f4;
    color: #41506b;
    background: #f8fbff;
  }

  .motor-search-main {
    min-width: 0;
    overflow: hidden;
  }

  .motor-toolbar {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 18px;
    flex-wrap: wrap;
  }

  .motor-search-field {
    position: relative;
    flex: 1 1 auto;
  }

  .motor-search-field svg {
    position: absolute;
    left: 18px;
    top: 50%;
    width: 19px;
    height: 19px;
    color: #707f96;
    transform: translateY(-50%);
  }

  .motor-search-field input,
  .motor-toolbar select {
    width: 100%;
    height: 46px;
    border: 1px solid #e1e8f3;
    border-radius: 14px;
    background: #ffffff;
    color: #13203a;
    font-size: 0.96rem;
    font-weight: 500;
    box-shadow: 0 10px 26px rgba(17, 42, 79, 0.04);
    outline: none;
  }

  .motor-search-field input {
    padding: 0 18px 0 48px;
  }

  .motor-search-field input:focus,
  .motor-toolbar select:focus {
    border-color: #97b9ff;
    box-shadow: 0 0 0 4px rgba(7, 92, 255, 0.08);
  }

  .motor-search-submit {
    display: none;
  }

  .motor-sort-box {
    flex: 0 0 200px;
    min-width: 180px;
  }

  .motor-toolbar select {
    padding: 0 16px;
    appearance: none;
    background-image: linear-gradient(45deg, transparent 50%, #70819a 50%), linear-gradient(135deg, #70819a 50%, transparent 50%);
    background-position: calc(100% - 20px) calc(50% - 3px), calc(100% - 14px) calc(50% - 3px);
    background-size: 6px 6px, 6px 6px;
    background-repeat: no-repeat;
    font-weight: 600;
  }

  .motor-results-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 14px;
    margin-bottom: 14px;
    flex-wrap: wrap;
  }

  .motor-results-meta h2 {
    margin: 0;
    color: #13203a;
    font-size: 1.12rem;
    font-weight: 850;
  }

  .motor-results-meta p {
    margin: 4px 0 0;
    color: #67768d;
    font-size: 0.95rem;
    font-weight: 500;
  }

  .motor-active-filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 8px;
  }

  .motor-active-filters span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    min-height: 34px;
    padding: 0 13px;
    border-radius: 999px;
    background: #edf4ff;
    color: #075cff;
    font-size: 0.84rem;
    font-weight: 700;
  }

  .motor-results-list {
    display: grid;
    gap: 12px;
  }

  .motor-card {
    position: relative;
    display: grid;
    grid-template-columns: 176px minmax(0, 1fr) 200px;
    align-items: center;
    gap: 18px;
    min-height: 116px;
    padding: 16px 24px 16px 18px;
    border: 1px solid #e8eef7;
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 10px 28px rgba(15, 35, 73, 0.045);
  }

  .motor-card-stretch {
    position: absolute;
    inset: 0;
    z-index: 1;
    border-radius: inherit;
  }

  .motor-card-favorite {
    position: absolute;
    right: 24px;
    top: 16px;
    z-index: 3;
    width: 32px;
    height: 32px;
    border: 1px solid #e3eaf4;
    border-radius: 50%;
    background: #ffffff;
    color: #62718a;
  }

  .motor-card-favorite.is-active {
    color: #dc2626;
    border-color: #fecaca;
    background: #fef2f2;
  }

  .motor-card-favorite.is-active svg {
    fill: #dc2626;
  }

  .motor-card-favorite svg {
    width: 16px;
    height: 16px;
    margin: auto;
    fill: none;
    stroke: currentColor;
    stroke-width: 2;
  }

  .motor-card-image {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .motor-card-image img {
    width: 100%;
    max-width: 144px;
    height: 92px;
    object-fit: contain;
  }

  .motor-card-copy {
    min-width: 0;
    padding-right: 6px;
    overflow: hidden;
  }

  .motor-card-copy h3 {
    margin: 0;
    color: #13203a;
    font-size: 1.16rem;
    line-height: 1.2;
    letter-spacing: -0.03em;
    font-weight: 800;
    overflow-wrap: anywhere;
  }

  .motor-card-rating {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-top: 8px;
    color: #62718a;
    font-size: 0.9rem;
    font-weight: 600;
  }

  .motor-card-rating svg {
    width: 15px;
    height: 15px;
    color: #ffb31a;
    fill: #ffb31a;
    stroke: #ffb31a;
  }

  .motor-card-rating b {
    color: #13203a;
  }

  .motor-card-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    margin-top: 11px;
    color: #556681;
    font-size: 0.9rem;
    font-weight: 500;
  }

  .motor-card-tags span {
    display: inline-flex;
    align-items: center;
    gap: 7px;
  }

  .motor-card-location {
    display: none;
  }

  .motor-card-side {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
    min-width: 150px;
    padding-right: 0;
  }

  .motor-card-price {
    text-align: right;
    padding-right: 48px;
  }

  .motor-card-price strong {
    display: block;
    color: #075cff;
    font-size: 1.03rem;
    line-height: 1;
    letter-spacing: -0.02em;
    font-weight: 900;
  }

  .motor-card-price span {
    display: block;
    margin-top: 6px;
    color: #5f7088;
    font-size: 0.78rem;
    font-weight: 600;
  }

  .motor-card-button {
    min-width: 122px;
    height: 40px;
    padding: 0 18px;
    border-radius: 12px;
    font-size: 0.92rem;
  }

  .motor-empty-state {
    padding: 42px 32px;
    border: 1px dashed #d8e3f4;
    border-radius: 24px;
    background: #f9fbff;
    text-align: center;
  }

  .motor-empty-state h3 {
    margin: 0 0 10px;
    font-size: 1.35rem;
    font-weight: 850;
    color: #13203a;
  }

  .motor-empty-state p {
    margin: 0;
    color: #68778f;
    font-size: 0.98rem;
    line-height: 1.7;
  }

  .motor-pagination {
    margin-top: 18px;
  }

  .motor-pagination nav {
    display: flex;
    justify-content: center;
  }

  .motor-pagination svg {
    width: 18px;
    height: 18px;
  }

  .motor-pagination .flex.justify-between {
    display: none;
  }

  .motor-pagination .hidden.sm\:flex-1,
  .motor-pagination .sm\:hidden {
    display: none;
  }

  .motor-pagination .relative.z-0.inline-flex {
    gap: 8px;
    box-shadow: none;
  }

  .motor-pagination span[aria-current="page"] span,
  .motor-pagination a,
  .motor-pagination span[aria-disabled="true"] span {
    min-width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 14px;
    border: 1px solid #dfe7f4;
    border-radius: 12px;
    background: #ffffff;
    color: #40516f;
    font-size: 0.94rem;
    font-weight: 700;
  }

  .motor-pagination span[aria-current="page"] span {
    border-color: #075cff;
    background: #eef5ff;
    color: #075cff;
  }

  @media (max-width: 1220px) {
    .motor-search-layout {
      grid-template-columns: 1fr;
    }

    .motor-search-sidebar {
      position: static;
    }
  }

  @media (max-width: 1120px) {
    .motor-card {
      grid-template-columns: 156px minmax(0, 1fr) 168px;
      gap: 14px;
      padding-right: 18px;
    }

    .motor-card-image img {
      max-width: 128px;
      height: 82px;
    }

    .motor-card-tags {
      gap: 12px;
      font-size: 0.84rem;
    }

    .motor-card-price {
      padding-right: 40px;
    }
  }

  @media (max-width: 980px) {
    .motor-toolbar {
      flex-direction: column;
      align-items: stretch;
    }

    .motor-sort-box {
      flex: 1 1 auto;
      min-width: 0;
    }

    .motor-results-head {
      flex-direction: column;
      align-items: stretch;
    }

    .motor-active-filters {
      justify-content: flex-start;
    }

    .motor-card {
      grid-template-columns: 132px minmax(0, 1fr);
      grid-template-areas:
        "image copy"
        "image side";
      align-items: start;
      row-gap: 12px;
    }

    .motor-card-image {
      grid-area: image;
      align-self: center;
    }

    .motor-card-copy {
      grid-area: copy;
    }

    .motor-card-side {
      grid-area: side;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      min-width: 0;
      width: 100%;
      padding-right: 0;
    }

    .motor-card-price {
      padding-right: 0;
      text-align: left;
    }
  }

  @media (max-width: 900px) {
    .motor-search-page {
      padding-top: 18px;
    }

    .motor-search-head h1 {
      font-size: 2.3rem;
    }

    .motor-card {
      grid-template-columns: 1fr;
      grid-template-areas: none;
      justify-items: center;
      text-align: center;
      padding-top: 46px;
    }

    .motor-card-image,
    .motor-card-copy,
    .motor-card-side {
      grid-area: auto;
    }

    .motor-card-copy {
      padding-right: 0;
    }

    .motor-card-tags {
      justify-content: center;
    }

    .motor-card-side,
    .motor-card-price {
      align-items: center;
      text-align: center;
      padding-right: 0;
    }

    .motor-card-side {
      flex-direction: column;
      width: auto;
    }
  }

  @media (max-width: 640px) {
    .motor-page-desktop-header {
      display: none;
    }

    .motor-mobile-topbar {
      display: block;
      position: sticky;
      top: 0;
      z-index: 50;
    }

    .motor-search-page {
      width: 100%;
      padding: 0 0 24px;
    }

    .motor-search-head,
    .motor-toolbar,
    .motor-results-meta p {
      display: none;
    }

    .motor-search-sidebar {
      position: fixed;
      inset: 0 0 0 auto;
      z-index: 60;
      width: min(320px, 85vw);
      transform: translateX(100%);
      transition: transform 0.28s ease;
      border-radius: 0;
      border: 0;
      box-shadow: -8px 0 40px rgba(0, 0, 0, 0.1);
      display: block !important;
      padding: 16px;
      overflow-y: auto;
    }

    .motor-search-sidebar.is-open {
      transform: translateX(0);
    }

    .motor-sidebar-mobile-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
      padding-bottom: 12px;
      border-bottom: 1px solid #eef2f8;
    }

    .motor-sidebar-mobile-head span {
      font-size: 16px;
      font-weight: 900;
      color: #111827;
    }

    .motor-sidebar-mobile-head button {
      display: grid;
      place-items: center;
      width: 36px;
      height: 36px;
      border: 0;
      border-radius: 50%;
      background: #f4f6f9;
      color: #111827;
      cursor: pointer;
    }

    .motor-sidebar-mobile-head button svg {
      width: 18px;
      height: 18px;
    }

    .motor-mobile-filter-backdrop {
      display: none;
      position: fixed;
      inset: 0;
      z-index: 55;
      background: rgba(0, 0, 0, 0.32);
    }

    .motor-mobile-filter-backdrop.is-open {
      display: block;
    }

    .motor-filter-actions {
      display: grid;
      gap: 10px;
      margin-top: 20px;
    }

    .motor-results-head {
      margin: 0;
      padding: 14px 16px 6px;
    }

    .motor-results-head h2 {
      font-size: 14px;
      color: #647084;
      font-weight: 600;
    }

    .motor-active-filters {
      justify-content: flex-start;
      gap: 6px;
      padding: 0 16px 10px;
    }

    .motor-active-filters span {
      min-height: 30px;
      padding: 0 10px;
      font-size: 12px;
    }

    .motor-search-layout {
      display: block;
      gap: 0;
    }

    .motor-results-list {
      gap: 0;
      background: #f5f6f8;
    }

    .motor-card {
      display: grid;
      grid-template-columns: 100px minmax(0, 1fr);
      grid-template-areas:
        "image copy"
        "image side";
      align-items: start;
      gap: 12px;
      justify-items: start;
      text-align: left;
      padding: 14px 16px;
      border: 0;
      border-bottom: 1px solid #eef2f8;
      border-radius: 0;
      background: #ffffff;
      box-shadow: none;
      min-height: 0;
    }

    .motor-card-image {
      grid-area: image;
      align-self: center;
    }

    .motor-card-image img {
      max-width: 100px;
      height: 72px;
    }

    .motor-card-copy {
      grid-area: copy;
      padding-right: 0;
      min-width: 0;
    }

    .motor-card-copy h3 {
      font-size: 15px;
      font-weight: 800;
      margin-right: 34px;
      line-height: 1.3;
      letter-spacing: -0.2px;
    }

    .motor-card-side {
      grid-area: side;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: flex-start;
      gap: 8px;
      min-width: 0;
      width: 100%;
      padding-right: 0;
    }

    .motor-card-price {
      text-align: left;
      padding-right: 0;
    }

    .motor-card-price strong {
      display: inline;
      font-size: 15px;
      letter-spacing: -0.2px;
    }

    .motor-card-price span {
      display: inline;
      margin-top: 0;
      margin-left: 3px;
      font-size: 12px;
      color: #94a3b8;
    }

    .motor-card-button {
      display: none;
    }

    .motor-card-favorite {
      position: absolute;
      right: 14px;
      top: 14px;
      width: 32px;
      height: 32px;
      border: 0;
      background: transparent;
      box-shadow: none;
      z-index: 3;
    }

    .motor-card-rating {
      margin-top: 4px;
      font-size: 12px;
      gap: 5px;
    }

    .motor-card-rating svg {
      width: 13px;
      height: 13px;
    }

    .motor-card-tags {
      margin-top: 6px;
      gap: 10px;
      font-size: 12px;
      color: #94a3b8;
    }

    .motor-card-tags span {
      gap: 4px;
    }

    .motor-card-tags svg {
      width: 13px;
      height: 13px;
      color: #94a3b8;
    }

    .motor-card-location {
      display: none;
    }

    .motor-empty-state {
      margin: 16px;
      border-radius: 18px;
    }

    .motor-pagination {
      margin-top: 0;
      padding: 16px;
      background: #f5f6f8;
    }

    .motor-pagination span[aria-current="page"] span,
    .motor-pagination a,
    .motor-pagination span[aria-disabled="true"] span {
      min-width: 38px;
      height: 38px;
      font-size: 14px;
    }
  }
</style>
@endpush

@section('content')
@php
  $selectedType = (string) request('type', '');
  $selectedEngineRanges = collect($selectedEngineRanges ?? [])->values()->all();
  $selectedTransmissions = collect($selectedTransmissions ?? [])->values()->all();
  $hasEngineFilters = ! empty($selectedEngineRanges);
  $hasTransmissionFilters = ! empty($selectedTransmissions);
  $mobileTitle = $selectedType ? optional($types->firstWhere('slug', $selectedType))->name : 'Cari Motor';
  $typeIcons = [
      'Semua' => '<path d="M5 5h5v5H5z"/><path d="M14 5h5v5h-5z"/><path d="M5 14h5v5H5z"/><path d="M14 14h5v5h-5z"/>',
      'Matic' => '<circle cx="7.5" cy="16.5" r="2.5"/><circle cx="17" cy="16.5" r="2.5"/><path d="M5 16h2.5l2.5-6h3.4l3.1 6H17"/><path d="M10 10 8.5 7.5H6"/><path d="M12 10h3.2"/>',
      'Sport' => '<circle cx="7.5" cy="16.5" r="2.5"/><circle cx="17" cy="16.5" r="2.5"/><path d="M5 16h3l2.5-5h4.5l2 5H17"/><path d="M10.5 11.2 9 8h-2"/><path d="M13 11h3.8"/>',
      'Naked' => '<circle cx="7.5" cy="16.5" r="2.5"/><circle cx="17" cy="16.5" r="2.5"/><path d="M5 16h3l2.5-4.8h4.3l2.2 4.8H17"/><path d="M10 11.2 8.6 8.3H6.4"/><path d="M13 10.9h3.2"/>',
      'Trail' => '<circle cx="7.5" cy="16.5" r="2.5"/><circle cx="17" cy="16.5" r="2.5"/><path d="M5 16h3l2.8-6.2h3.8l2.4 6.2H17"/><path d="M11 9.8 9.5 7H7.2"/><path d="M13.3 10h3"/>',
      'Classic' => '<circle cx="7.5" cy="16.5" r="2.5"/><circle cx="17" cy="16.5" r="2.5"/><path d="M5 16h3l2.3-4.6h4.5l2.2 4.6H17"/><path d="M10 11.4V8.2h3.8"/><path d="M14.2 8.2h2.3"/>',
  ];
  $engineOptions = [
      'all' => 'Semua',
      'under-125' => '< 125 cc',
      '125-150' => '125 - 150 cc',
      '150-200' => '150 - 200 cc',
      'over-200' => '> 200 cc',
  ];
  $transmissionOptions = [
      'all' => 'Semua',
      'Matic' => 'Matic',
      'Manual' => 'Manual',
  ];
  $selectedMinPrice = $priceRange['selected_min'];
  $selectedMaxPrice = $priceRange['selected_max'];
  $activeFilterLabels = collect([
      $selectedType ? optional($types->firstWhere('slug', $selectedType))->name : null,
      request('q') ? 'Pencarian: '.request('q') : null,
      $hasEngineFilters ? 'CC: '.implode(', ', array_map(fn ($range) => $engineOptions[$range] ?? $range, $selectedEngineRanges)) : null,
      $hasTransmissionFilters ? 'Transmisi: '.implode(', ', $selectedTransmissions) : null,
      ($selectedMinPrice > $priceRange['min'] || $selectedMaxPrice < $priceRange['max']) ? 'Harga: Rp '.number_format($selectedMinPrice, 0, ',', '.').' - Rp '.number_format($selectedMaxPrice, 0, ',', '.') : null,
  ])->filter()->values();
@endphp

<section class="motor-search-page">
  <form method="GET" action="{{ route('motors.index') }}" class="motor-search-shell" data-catalog-form>
    <input type="hidden" name="type" value="{{ $selectedType }}" data-type-input>
    <div class="motor-search-head">
      <h1>Daftar Motor</h1>
      <p>Temukan motor terbaik untuk perjalananmu dengan harga terjangkau dan layanan terbaik.</p>
    </div>

    <div class="motor-search-layout">
      <aside class="motor-search-sidebar" aria-label="Filter pencarian motor">
        <section class="motor-filter-section">
          <h2 class="motor-filter-title">Tipe Motor</h2>
          <div class="motor-type-list">
            <button type="button" class="motor-type-button {{ $selectedType === '' ? 'is-active' : '' }}" data-type-trigger="">
              <svg viewBox="0 0 24 24" aria-hidden="true">{!! $typeIcons['Semua'] !!}</svg>
              <span>Semua</span>
            </button>
            @foreach($types as $type)
              <button type="button" class="motor-type-button {{ $selectedType === $type->slug ? 'is-active' : '' }}" data-type-trigger="{{ $type->slug }}">
                <svg viewBox="0 0 24 24" aria-hidden="true">{!! $typeIcons[$type->name] ?? $typeIcons['Semua'] !!}</svg>
                <span>{{ $type->name }}</span>
              </button>
            @endforeach
          </div>
        </section>

        <section class="motor-filter-section">
          <h2 class="motor-filter-title">Rentang Harga / Hari</h2>
          <div class="motor-range-values" data-range-label>
            Rp {{ number_format($selectedMinPrice, 0, ',', '.') }} - Rp {{ number_format($selectedMaxPrice, 0, ',', '.') }}
          </div>
          <div class="motor-range-wrap" data-range-wrap>
            <div class="motor-range-track"></div>
            <div class="motor-range-progress" data-range-progress></div>
            <input type="range" name="price_min" min="{{ $priceRange['min'] }}" max="{{ $priceRange['max'] }}" step="5000" value="{{ $selectedMinPrice }}" data-range-min>
            <input type="range" name="price_max" min="{{ $priceRange['min'] }}" max="{{ $priceRange['max'] }}" step="5000" value="{{ $selectedMaxPrice }}" data-range-max>
          </div>
        </section>

        <section class="motor-filter-section">
          <h2 class="motor-filter-title">Kapasitas Mesin</h2>
          <div class="motor-check-group" data-check-group="engine">
            @foreach($engineOptions as $value => $label)
              <label class="motor-check-item">
                <input type="checkbox" name="engine[]" value="{{ $value }}" {{ $value === 'all' ? (! $hasEngineFilters ? 'checked' : '') : (in_array($value, $selectedEngineRanges, true) ? 'checked' : '') }} data-check-option="{{ $value }}">
                <span>{{ $label }}</span>
              </label>
            @endforeach
          </div>
        </section>

        <section class="motor-filter-section">
          <h2 class="motor-filter-title">Transmisi</h2>
          <div class="motor-check-group" data-check-group="transmission">
            @foreach($transmissionOptions as $value => $label)
              <label class="motor-check-item">
                <input type="checkbox" name="transmission[]" value="{{ $value }}" {{ $value === 'all' ? (! $hasTransmissionFilters ? 'checked' : '') : (in_array($value, $selectedTransmissions, true) ? 'checked' : '') }} data-check-option="{{ $value }}">
                <span>{{ $label }}</span>
              </label>
            @endforeach
          </div>
        </section>

          <div class="motor-filter-actions">
            <button type="submit" class="motor-apply-btn">Terapkan Filter</button>
            <a href="{{ route('motors.index') }}" class="motor-reset-btn">Reset Semua</a>
          </div>
      </aside>

      <div class="motor-search-main">
        <div class="motor-toolbar">
          <label class="motor-search-field" for="catalog-query">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            <input id="catalog-query" name="q" type="search" value="{{ request('q') }}" placeholder="Cari motor atau merk" autocomplete="off">
            <button type="submit" class="motor-search-submit">Cari</button>
          </label>

          <div class="motor-sort-box">
            <select name="sort" aria-label="Urutkan hasil" onchange="this.form.submit()">
              <option value="popular" @selected($currentSort === 'popular')>Urutkan: Popularitas</option>
              <option value="price_low" @selected($currentSort === 'price_low')>Urutkan: Harga Terendah</option>
              <option value="price_high" @selected($currentSort === 'price_high')>Urutkan: Harga Tertinggi</option>
              <option value="rating" @selected($currentSort === 'rating')>Urutkan: Rating Terbaik</option>
            </select>
          </div>
        </div>

        <div class="motor-results-head">
          <div class="motor-results-meta">
            <h2>{{ $motors->total() }} motor ditemukan</h2>
            <p>Filter, cari, dan pilih unit yang paling cocok untuk rute dan budget perjalananmu.</p>
          </div>

          @if($activeFilterLabels->isNotEmpty())
            <div class="motor-active-filters" aria-label="Filter aktif">
              @foreach($activeFilterLabels as $label)
                <span>{{ $label }}</span>
              @endforeach
            </div>
          @endif
        </div>

        <div class="motor-results-list">
          @forelse($motors as $motor)
            <article class="motor-card">
              <a href="{{ route('motors.show', $motor) }}" class="motor-card-stretch" aria-label="Lihat detail {{ $motor->name }}"></a>
              @auth
              <button type="button" class="motor-card-favorite {{ in_array($motor->id, $wishlistIds ?? []) ? 'is-active' : '' }}" data-wishlist-slug="{{ $motor->slug }}" aria-label="Simpan {{ $motor->name }} ke favorit">
                <svg viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
              </button>
              @else
              <a href="{{ route('login') }}" class="motor-card-favorite" aria-label="Login untuk simpan favorit">
                <svg viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>
              </a>
              @endauth

              <div class="motor-card-image">
                <img src="{{ $motor->image_url }}" alt="{{ $motor->name }}" loading="lazy">
              </div>

              <div class="motor-card-copy">
                <h3>{{ $motor->name }}</h3>
                <div class="motor-card-rating">
                  <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                  <span><b>{{ number_format($motor->rating, 1) }}</b> ({{ $motor->reviews_count }}+ review)</span>
                </div>
                <div class="motor-card-tags">
                  <span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 13a8 8 0 0 1 16 0v3a2 2 0 0 1-2 2h-3.5"/><path d="M4 13v3a2 2 0 0 0 2 2h3"/><path d="M9 18v-3h6v3"/><path d="M7 13h10"/></svg> 2 Helm</span>
                  <span><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 9h8v7H8z"/><path d="M5 12H3"/><path d="M21 12h-2"/><path d="M10 6V4"/><path d="M14 6V4"/></svg> {{ $motor->cc }} cc</span>
                  <span><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="7"/><path d="M12 5v3"/><path d="M12 16v3"/><path d="M5 12h3"/><path d="M16 12h3"/><circle cx="12" cy="12" r="2"/></svg> {{ $motor->transmission }}</span>
                </div>
                <div class="motor-card-location">{{ $motor->type->name }} · {{ $motor->location->city }}</div>
              </div>

              <div class="motor-card-side">
                <div class="motor-card-price">
                  <strong>Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}</strong>
                  <span>/hari</span>
                </div>
                <a href="{{ route('motors.show', $motor) }}" class="motor-card-button">Lihat Detail</a>
              </div>
            </article>
          @empty
            <div class="motor-empty-state">
              <h3>Tidak ada motor yang cocok</h3>
              <p>Coba longgarkan filter harga, kapasitas mesin, atau transmisi agar hasil pencarian lebih banyak.</p>
            </div>
          @endforelse
        </div>

        @if($motors->hasPages())
          <div class="motor-pagination">
            {{ $motors->onEachSide(1)->links() }}
          </div>
        @endif
      </div>
    </div>
  </form>
</section>

@push('scripts')
<script>
  (() => {
    const catalogForm = document.querySelector('[data-catalog-form]');
    const typeInput = document.querySelector('[data-type-input]');
    const rangeMin = document.querySelector('[data-range-min]');
    const rangeMax = document.querySelector('[data-range-max]');
    const rangeLabel = document.querySelector('[data-range-label]');
    const rangeProgress = document.querySelector('[data-range-progress]');

    if (catalogForm && typeInput) {
      document.querySelectorAll('[data-type-trigger]').forEach((button) => {
        button.addEventListener('click', () => {
          typeInput.value = button.getAttribute('data-type-trigger') || '';
          catalogForm.submit();
        });
      });
    }

    if (rangeMin && rangeMax && rangeLabel && rangeProgress) {
      const formatCurrency = (value) => `Rp ${Number(value).toLocaleString('id-ID')}`;

      const syncRange = (source) => {
        let minValue = Number(rangeMin.value);
        let maxValue = Number(rangeMax.value);

        if (maxValue - minValue < 5000) {
          if (source === rangeMin) {
            minValue = maxValue - 5000;
            rangeMin.value = String(minValue);
          } else {
            maxValue = minValue + 5000;
            rangeMax.value = String(maxValue);
          }
        }

        const min = Number(rangeMin.min);
        const max = Number(rangeMin.max);
        const left = ((minValue - min) / (max - min)) * 100;
        const right = ((maxValue - min) / (max - min)) * 100;

        rangeProgress.style.left = `${left}%`;
        rangeProgress.style.right = `${100 - right}%`;
        rangeLabel.textContent = `${formatCurrency(minValue)} - ${formatCurrency(maxValue)}`;
      };

      syncRange();
      rangeMin.addEventListener('input', () => syncRange(rangeMin));
      rangeMax.addEventListener('input', () => syncRange(rangeMax));
    }

    document.querySelectorAll('[data-check-group]').forEach((group) => {
      const allInput = group.querySelector('[data-check-option="all"]');
      const specificInputs = Array.from(group.querySelectorAll('input:not([data-check-option="all"])'));

      const syncState = (changedInput) => {
        if (!allInput) {
          return;
        }

        if (changedInput === allInput && allInput.checked) {
          specificInputs.forEach((input) => {
            input.checked = false;
          });
        }

        if (changedInput !== allInput && changedInput?.checked) {
          allInput.checked = false;
        }

        if (specificInputs.every((input) => !input.checked)) {
          allInput.checked = true;
        }
      };

      [allInput, ...specificInputs].filter(Boolean).forEach((input) => {
        input.addEventListener('change', () => {
          syncState(input);
          catalogForm?.requestSubmit();
        });
      });

      syncState();
    });

    if (rangeMin && rangeMax && catalogForm) {
      [rangeMin, rangeMax].forEach((input) => {
        input.addEventListener('change', () => catalogForm.requestSubmit());
      });
    }

    document.querySelectorAll('[data-wishlist-slug]').forEach((btn) => {
      btn.addEventListener('click', async (e) => {
        e.preventDefault();
        e.stopPropagation();
        const slug = btn.dataset.wishlistSlug;
        try {
          const res = await fetch(`/wishlist/${slug}`, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
              'Accept': 'application/json',
            },
          });
          const data = await res.json();
          if (data.status === 'added') {
            btn.classList.add('is-active');
          } else if (data.status === 'removed') {
            btn.classList.remove('is-active');
          }
        } catch (e) {
          console.error(e);
        }
      });
    });

    (() => {
      const sidebar = document.querySelector('.motor-search-sidebar');
      const openBtn = document.querySelector('[data-mobile-filter-open]');
      if (!sidebar || !openBtn) return;

      let backdrop = document.querySelector('.motor-mobile-filter-backdrop');
      if (!backdrop) {
        backdrop = document.createElement('div');
        backdrop.className = 'motor-mobile-filter-backdrop';
        document.body.appendChild(backdrop);
      }

      let mobileHead = sidebar.querySelector('.motor-sidebar-mobile-head');
      if (!mobileHead) {
        mobileHead = document.createElement('div');
        mobileHead.className = 'motor-sidebar-mobile-head';
        mobileHead.innerHTML = '<span>Filter</span><button type="button" aria-label="Tutup filter" data-mobile-filter-close><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 6 6 18"/><path d="M6 6l12 12"/></svg></button>';
        sidebar.insertBefore(mobileHead, sidebar.firstChild);
      }

      const closeBtn = sidebar.querySelector('[data-mobile-filter-close]');

      const setOpen = (open) => {
        sidebar.classList.toggle('is-open', open);
        backdrop.classList.toggle('is-open', open);
        document.body.style.overflow = open ? 'hidden' : '';
      };

      openBtn.addEventListener('click', () => setOpen(true));
      closeBtn?.addEventListener('click', () => setOpen(false));
      backdrop.addEventListener('click', () => setOpen(false));

      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('is-open')) {
          setOpen(false);
        }
      });
    })();
  })();
</script>
@endpush
@endsection
