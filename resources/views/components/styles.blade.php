<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@700;800&display=swap');

    * {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .font-display {
        font-family: 'Outfit', sans-serif;
    }

    :root {
        --primary: #1B6578;
        --primary-light: #2a8fa3;
        --slate-dark: #0f172a;
        --slate-light: #f8fafc;
    }

    body {
        transition: background-color 0.3s ease;
    }

    .bg-gradient-subtle {
        background: #f8fafc;
    }

    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(15, 23, 42, 0.05);
    }

    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(27, 101, 120, 0.08);
        border-color: rgba(27, 101, 120, 0.1);
    }

    .sidebar-item {
        position: relative;
        transition: all 0.2s ease;
    }

    .sidebar-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 0;
        background: var(--primary);
        border-radius: 0 3px 3px 0;
        transition: height 0.3s ease;
    }

    .sidebar-item.active {
        background-color: rgba(27, 101, 120, 0.15);
        color: white;
    }

    .sidebar-item.active::before {
        height: 20px;
    }

    @keyframes slideInNumber {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-number {
        animation: slideInNumber 0.5s ease 0.2s both;
    }

    .avatar-gradient {
        background: var(--primary);
    }

    html {
        scroll-behavior: smooth;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .filter-select {
        position: relative;
    }

    .filter-select select {
        appearance: none;
        padding-right: 28px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23475569' d='M1 4.5l5 5 5-5'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-color: #f1f5f9;
        cursor: pointer;
    }

    .filter-select select:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(27, 101, 120, 0.1);
        border-color: #1B6578;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 3rem 1.5rem;
    }

    .empty-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(27, 101, 120, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #cbd5e1;
    }

    .rupiah {
        font-variant-numeric: tabular-nums;
    }

    /* Profile Dropdown */
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        z-index: 50;
        min-width: 200px;
        margin-top: 0.5rem;
        animation: slideDown 0.3s ease;
    }

    .dropdown-menu.active {
        display: block;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: #475569;
        text-decoration: none;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .dropdown-item:first-child {
        border-radius: 12px 12px 0 0;
    }

    .dropdown-item:last-child {
        border-bottom: none;
        border-radius: 0 0 12px 12px;
    }

    .dropdown-item:hover {
        background-color: #f8fafc;
        color: #1B6578;
    }

    .dropdown-item.logout:hover {
        background-color: #fee2e2;
        color: #dc2626;
    }

    /* Form Styles */
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #cbd5e1;
        border-radius: 0.75rem;
        font-size: 1rem;
        transition: all 0.2s ease;
    }

    .form-input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(27, 101, 120, 0.1);
        border-color: #1B6578;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
    }

    .btn-primary {
        background-color: #1B6578;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px rgba(27, 101, 120, 0.2);
        border: none;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }

    .btn-primary:hover {
        background-color: #154a5c;
    }

    .btn-secondary {
        background-color: #f1f5f9;
        color: #1f2937;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background-color: #e2e8f0;
    }

    .alert-success {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background-color: #f0fdf4;
        border: 1px solid #86efac;
        border-radius: 0.5rem;
    }

    .alert-error {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background-color: #fef2f2;
        border: 1px solid #fca5a5;
        border-radius: 0.5rem;
    }

    tbody tr {
        transition: background-color 0.2s ease;
    }

    tbody tr:hover {
        background-color: rgba(27, 101, 120, 0.03);
    }
</style>
