@extends('layouts.app')

@section('content')
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Transactions Lists
                </h2>
                <!--
                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="index.html">Dashboard /</a>
                        </li>
                        <li class="font-medium text-primary">Tables</li>
                    </ol>
                </nav>
                -->
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Table Section Start ===== -->
            <div class="flex flex-col gap-10">
                <!-- ====== Table Start ===== -->
                <div class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                    <div class="max-w-full overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                                    <th class="min-w-[180px] px-4 py-4 font-medium text-black dark:text-white">Transaction Date</th>
                                    <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">Account</th>
                                    <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">Amount</th>
                                    <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">Category</th>
                                    <th class="min-w-[250px] px-4 py-4 font-medium text-black dark:text-white">Description</th>
                                    <th class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                            <p class="text-black dark:text-white">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('F j, Y, g:i A') }}</p>
                                        </td>                                        
                                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                            <p class="text-black dark:text-white">{{ $transaction->account->account_name }}</p>
                                        </td>
                                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                            <p class="text-black dark:text-white">{{ $transaction->amount }}</p>
                                        </td>
                                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                            <p class="text-black dark:text-white">{{ $transaction->category }}</p>
                                        </td>
                                        
                                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                            <p class="text-black dark:text-white">{{ $transaction->description }}</p>
                                        </td>
                                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                            <div class="flex items-center space-x-3.5">
                                                <button class="hover:text-primary">
                                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- SVG for eye icon -->
                                                        <path d="M8.99981 14.8219C3.43106 14.8219 0.674805 9.50624 0.562305 9.28124C0.47793 9.11249 0.47793 8.88749 0.562305 8.71874C0.674805 8.49374 3.43106 3.20624 8.99981 3.20624C14.5686 3.20624 17.3248 8.49374 17.4373 8.71874C17.5217 8.88749 17.5217 9.11249 17.4373 9.28124C17.3248 9.50624 14.5686 14.8219 8.99981 14.8219ZM1.85605 8.99999C2.4748 10.0406 4.89356 13.5562 8.99981 13.5562C13.1061 13.5562 15.5248 10.0406 16.1436 8.99999C15.5248 7.95936 13.1061 4.44374 8.99981 4.44374C4.89356 4.44374 2.4748 7.95936 1.85605 8.99999Z" fill="" />
                                                        <path d="M9 11.3906C7.67812 11.3906 6.60938 10.3219 6.60938 9C6.60938 7.67813 7.67812 6.60938 9 6.60938C10.3219 6.60938 11.3906 7.67813 11.3906 9C11.3906 10.3219 10.3219 11.3906 9 11.3906ZM9 7.875C8.38125 7.875 7.875 8.38125 7.875 9C7.875 9.61875 8.38125 10.125 9 10.125C9.61875 10.125 10.125 9.61875 10.125 9C10.125 8.38125 9.61875 7.875 9 7.875Z" fill="" />
                                                    </svg>
                                                </button>
                                                <button class="hover:text-primary">
                                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- SVG for edit icon -->
                                                        <path d="M13.7535 2.47502H11.5879V1.9969C11.5879 1.15315 10.9129 0.478149 10.0691 0.478149H7.90352C7.05977 0.478149 6.38477 1.15315 6.38477 1.9969V2.47502H4.21914C3.40352 2.47502 2.72852 3.15002 2.72852 3.96565V4.8094C2.72852 5.42815 3.09414 5.9344 3.62852 6.1594L4.07852 15.4688C4.13477 16.6219 5.09102 17.5219 6.24414 17.5219H11.7004C12.8535 17.5219 13.8098 16.6219 13.866 15.4688L14.3441 6.13127C14.8785 5.90627 15.2441 5.3719 15.2441 4.78127V3.93752C15.2441 3.15002 14.5691 2.47502 13.7535 2.47502ZM7.67852 1.9969C7.67852 1.85627 7.79102 1.74377 7.93164 1.74377H10.0973C10.2379 1.74377 10.3504 1.85627 10.3504 1.9969V2.47502H7.70664V1.9969H7.67852ZM4.02227 3.96565C4.02227 3.85315 4.10664 3.74065 4.24727 3.74065H13.7535C13.866 3.74065 13.9785 3.82502 13.9785 3.96565V4.8094C13.9785 4.9219 13.8941 5.0344 13.7535 5.0344H4.24727C4.13477 5.0344 4.02227 4.95002 4.02227 4.8094V3.96565ZM11.7285 16.2563H6.27227C5.79414 16.2563 5.40039 15.8906 5.37227 15.3844L4.95039 6.2719H13.0785L12.6566 15.3844C12.6004 15.8625 12.2066 16.2563 11.7285 16.2563Z" fill="" />
                                                    </svg>
                                                </button>
                                                <button class="hover:text-primary">
                                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <!-- SVG for delete icon -->
                                                        <path d="M14.1211 1.87892C15.0515 2.80931 15.6725 3.96755 15.6725 5.25C15.6725 7.19925 14.1963 9.01945 12.4221 9.65441L10.875 15.3274C10.7785 15.6452 10.3288 15.7933 10.1797 15.4399L8.74954 11.2944C8.50525 10.8749 8.37792 10.4691 8.37792 10.125C8.37792 9.29914 8.92201 8.56056 9.68249 8.56056C10.4393 8.56056 11.1414 9.04786 11.4689 9.81278C11.7823 10.5171 11.8053 11.5546 11.1889 12.1384L10.5004 12.8138C9.58669 13.6285 8.10669 13.7459 7.32886 12.9681L4.375 10.0324C3.19732 8.85501 2.67205 7.23084 2.67205 5.25C2.67205 3.43044 3.60456 1.85899 4.84954 0.856781C5.97625 0.000315979 7.46888 -0.286287 8.79907 0.142246L10.2934 0.82856C11.6287 1.349 12.7381 2.12252 13.6211 3.06665C14.5042 4.01078 15.1298 5.16182 15.45 6.43065L16.0667 8.74351C16.1395 9.03413 16.0671 9.34409 15.8641 9.58232L13.8165 12.1049C13.5455 12.4206 13.3064 12.7075 13.1211 13C12.8506 13.3938 12.6403 13.7991 12.234 14.2344C11.2277 15.2686 9.50147 14.8853 8.50161 13.7488C7.92677 13.1402 7.77127 12.298 8.00506 11.5197C8.24165 10.7305 9.0386 10.1794 9.9375 10.0781C10.3476 10.0385 10.6684 9.72493 10.7637 9.33583C10.8676 8.92414 10.5959 8.58053 10.2129 8.45695L7.73923 7.63974C7.29338 7.48323 6.80585 7.68304 6.50954 8.11935L6.31595 8.40849L5.42559 8.25351L4.73666 8.13841C3.41853 7.91364 2.4175 6.61205 2.14074 5.19138L1.94864 4.14226C1.68277 2.73824 2.15212 1.20912 3.14221 0.219049C4.13229 -0.771027 5.66141 -1.24037 7.06543 -0.974501C8.48609 -0.697743 9.78769 0.303292 10.0125 1.62141L10.1285 2.28915L11.8809 4.29249L11.3132 7.86778L14.1211 5.46574C14.5913 5.08473 14.9779 4.48393 15.1633 3.75771L15.4499 2.53059C15.7558 1.15825 16.2461 0.0636156 17.0211 -0.680862L14.1211 1.87892Z" fill="" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <p class="text-black dark:text-white">No transactions found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>                            
                        </table>
                    </div>

                    <!-- ====== Pagination Start ===== -->
                    <div class="flex justify-between items-center p-4 sm:p-6 xl:p-7.5">
                        <div>
                            Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries
                        </div>

                        <nav>
                            <ul class="flex flex-wrap items-center gap-2">
                                {{-- Previous Page Link --}}
                                <li>
                                    <a href="{{ $transactions->appends(['limit' => $perPage, 'q' => $q, 'account_id' => $account_id])->previousPageUrl() }}"
                                    class="flex items-center justify-center rounded px-3 py-1.5 text-xs font-medium {{ $transactions->onFirstPage() ? 'cursor-not-allowed bg-[#EDEFF1] dark:bg-graydark text-black dark:text-white' : 'hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white' }}">
                                        Previous
                                    </a>
                                </li>

                                {{-- Pagination Elements --}}
                                @foreach ($transactions->links()->elements as $element)
                                    @if (is_string($element))
                                        <li>
                                            <span class="flex items-center justify-center px-3 py-1.5 text-xs font-medium text-black dark:text-white">{{ $element }}</span>
                                        </li>
                                    @endif

                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            <li>
                                                <a href="{{ $transactions->appends(['limit' => $perPage, 'q' => $q, 'account_id' => $account_id])->url($page) }}"
                                                class="flex items-center justify-center rounded px-3 py-1.5 font-medium {{ $page == $transactions->currentPage() ? 'bg-primary text-white' : 'hover:bg-primary hover:text-white' }}">
                                                    {{ $page }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                <li>
                                    <a href="{{ $transactions->appends(['limit' => $perPage, 'q' => $q, 'account_id' => $account_id])->nextPageUrl() }}"
                                    class="flex items-center justify-center rounded px-3 py-1.5 text-xs font-medium {{ $transactions->hasMorePages() ? 'hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white' : 'cursor-not-allowed bg-[#EDEFF1] dark:bg-graydark text-black dark:text-white' }}">
                                        Next
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- ====== Pagination End ===== -->
            
                </div>
                <!-- ====== Table End ===== -->
            </div>
            <!-- ====== Table Section End ===== -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
@endsection