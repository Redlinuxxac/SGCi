<div>
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('docs.manual_title') }}</h1>

    <div class="prose prose-lg dark:prose-invert max-w-none">
        <p class="lead">
            {{ __('docs.welcome_message') }}
        </p>

        <div class="mt-8 p-6 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <h2 class="text-2xl font-semibold">{{ __('docs.table_of_contents') }}</h2>
            <ul class="mt-4 space-y-2">
                <li><a href="#introduccion" class="text-blue-500 hover:underline">{{ __('docs.intro_first_steps') }}</li>
                <li><a href="#socios" class="text-blue-500 hover:underline">2. {{ __('docs.module_members') }}</a></li>
                <li><a href="#prestamos" class="text-blue-500 hover:underline">3. {{ __('docs.module_loans') }}</a></li>
                <li><a href="#ahorros" class="text-blue-500 hover:underline">4. {{ __('docs.module_savings') }}</a></li>
                <li><a href="#contabilidad" class="text-blue-500 hover:underline">5. {{ __('docs.module_accounting') }}</a></li>
                <li><a href="#seguridad" class="text-blue-500 hover:underline">6. {{ __('docs.module_security') }}</a></li>
            </ul>
        </div>

        <section id="introduccion" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">1. {{ __('docs.intro_first_steps') }}</h2>
            <p class="mt-4">
                {!! __('docs.intro_text_1') !!}
            </p>
            <p>
                {!! __('docs.intro_text_2') !!}
            </p>
        </section>

        <section id="socios" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">2. {{ __('docs.module_members') }}</h2>
            <p class="mt-4">
                {!! __('docs.members_module_text_1') !!}
            </p>
            <h3 class="text-xl font-semibold mt-6">{{ __('docs.functionalities_title') }}</h3>
            <ul class="list-disc pl-6 space-y-2">
                <li><strong>{{ __('docs.view_members') }}</strong> {!! __('docs.view_members_desc') !!}</li>
                <li><strong>{{ __('docs.create_new_member') }}</strong>
                    <ol class="list-decimal pl-6 mt-2">
                        <li>{!! __('docs.create_new_member_step_1') !!}</li>
                        <li>{!! __('docs.create_new_member_step_2') !!}</li>
                        <li>{!! __('docs.create_new_member_step_3') !!}</li>
                    </ol>
                </li>
                <li><strong>{{ __('docs.edit_member') }}</strong>
                    <ol class="list-decimal pl-6 mt-2">
                        <li>{!! __('docs.edit_member_step_1') !!}</li>
                        <li>{!! __('docs.edit_member_step_2') !!}</li>
                        <li>{!! __('docs.edit_member_step_3') !!}</li>
                    </ol>
                </li>
                <li><strong>{{ __('docs.delete_member') }}</strong>
                    <ol class="list-decimal pl-6 mt-2">
                        <li>{!! __('docs.delete_member_step_1') !!}</li>
                        <li>{!! __('docs.delete_member_step_2') !!}</li>
                    </ol>
                </li>
            </ul>
        </section>

        <section id="prestamos" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">3. {{ __('docs.module_loans') }}</h2>
            <p class="mt-4">
                {!! __('docs.loans_module_text_1') !!}
            </p>
            <h3 class="text-xl font-semibold mt-6">{{ __('docs.key_fields_title') }}</h3>
            <ul class="list-disc pl-6 space-y-2">
                <li><strong>{{ __('docs.member_field') }}</strong> {!! __('docs.member_field_desc') !!}</li>
                <li><strong>{{ __('docs.amount_field') }}</strong> {!! __('docs.amount_field_desc') !!}</li>
                <li><strong>{{ __('docs.interest_rate_field') }}</strong> {!! __('docs.interest_rate_field_desc') !!}</li>
                <li><strong>{{ __('docs.term_field') }}</strong> {!! __('docs.term_field_desc') !!}</li>
                <li><strong>{{ __('docs.status_field') }}</strong> {!! __('docs.status_field_desc') !!}</li>
            </ul>
        </section>
        
        <section id="ahorros" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">4. {{ __('docs.module_savings') }}</h2>
            <p class="mt-4">
                {!! __('docs.savings_module_text_1') !!}
            </p>
        </section>

        <section id="contabilidad" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">5. {{ __('docs.module_accounting') }}</h2>
            <p class="mt-4">
                {!! __('docs.accounting_module_text_1') !!}
            </p>
            <h3 class="text-xl font-semibold mt-6">{{ __('docs.chart_of_accounts_subtitle') }}</h3>
            <p>{!! __('docs.chart_of_accounts_desc') !!}</p>
            <h3 class="text-xl font-semibold mt-6">{{ __('docs.journal_entries_subtitle') }}</h3>
            <p>{!! __('docs.journal_entries_desc_1') !!}</p>
            <ol class="list-decimal pl-6 mt-2">
                <li>{!! __('docs.journal_entries_step_1') !!}</li>
                <li>{!! __('docs.journal_entries_step_2') !!}</li>
                <li>{!! __('docs.journal_entries_step_3') !!}</li>
                <li>{!! __('docs.journal_entries_step_4_important') !!}</li>
                <li>{!! __('docs.journal_entries_step_5') !!}</li>
            </ol>
            <p>{!! __('docs.journal_entries_desc_2') !!}</p>
        </section>
        
        <section id="seguridad" class="mt-12 scroll-mt-24">
            <h2 class="text-2xl font-bold border-b pb-2">6. {{ __('docs.module_security') }}</h2>
            <p class="mt-4">
                {!! __('docs.security_module_text_1') !!}
            </p>
            <h3 class="text-xl font-semibold mt-6">{{ __('docs.roles_subtitle') }}</h3>
            <p>{!! __('docs.roles_desc') !!}</p>
            <h3 class="text-xl font-semibold mt-6">{{ __('docs.permissions_subtitle') }}</h3>
            <p>{!! __('docs.permissions_desc') !!}</p>
        </section>
    </div>
</div>