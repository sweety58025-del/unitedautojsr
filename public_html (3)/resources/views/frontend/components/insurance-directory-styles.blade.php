<style>
    .insurance-directory {
        padding: 32px 0 120px;
    }

    .insurance-directory__intro {
        max-width: 760px;
        margin: 0 auto 42px;
        text-align: center;
    }

    .insurance-directory__intro p {
        max-width: 650px;
        margin: 18px auto 0;
        color: #666e85;
        font-size: 18px;
        line-height: 1.75;
    }

    .insurance-directory__panel {
        max-width: 960px;
        margin: 0 auto;
        padding: 36px;
        border: 1px solid #e5e5e5;
        border-top: 4px solid #d70006;
        background: #fff;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
    }

    .insurance-directory__panel h2 {
        margin-bottom: 24px;
        font-size: 28px;
        text-align: center;
    }

    .insurance-directory__list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px 24px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .insurance-directory__list li {
        position: relative;
        padding: 14px 18px 14px 42px;
        border: 1px solid #edf0f4;
        background: #f8fafc;
        color: #333;
        font-size: 18px;
        font-weight: 600;
        line-height: 1.45;
        transition: transform 0.2s ease, border-color 0.2s ease, background-color 0.2s ease;
    }

    .insurance-directory__list li::before {
        position: absolute;
        top: 50%;
        left: 18px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #d70006;
        content: '';
        transform: translateY(-50%);
    }

    .insurance-directory__list li:hover {
        border-color: #d70006;
        background: #fff;
        transform: translateY(-2px);
    }

    .insurance-directory__action {
        margin-top: 30px;
        text-align: center;
    }

    @media (max-width: 767px) {
        .insurance-directory {
            padding: 16px 0 80px;
        }

        .insurance-directory__intro p {
            font-size: 17px;
        }

        .insurance-directory__panel {
            padding: 26px 20px;
        }

        .insurance-directory__panel h2 {
            font-size: 24px;
        }

        .insurance-directory__list {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .insurance-directory__list li {
            font-size: 17px;
        }
    }
</style>
