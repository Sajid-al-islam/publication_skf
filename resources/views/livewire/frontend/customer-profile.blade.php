<section class="profile__area pt-120 pb-120">
    <!-- header-area-end -->
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu ">
                        <ul>
                            <li><a class="hind-siliguri" href="/">হোম</a></li>
                            <li><a class="hind-siliguri" href="#" class="active">পোফাইল</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- entry-header-area-start -->
    <div class="entry-header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="entry-header-title">
                        <h2>My-Account</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- entry-header-area-end -->
    <!-- my account wrapper start -->
    <div class="my-account-wrapper mb-70">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#orders" wire:click="change_tab('orders')" class="{{ $active_tab=="orders"?"active":'' }}" data-bs-toggle="tab">
                                            <i class="fa fa-cart-arrow-down"></i>
                                            Orders
                                        </a>
                                        <a href="#address-edit" wire:click="change_tab('address')" class="{{ $active_tab=="address"?"active":'' }}" data-bs-toggle="tab">
                                            <i class="fa fa-map-marker"></i>
                                            address
                                        </a>
                                        <a href="#account-info" wire:click="change_tab('account')" class="{{ $active_tab=="account"?"active":'' }}" data-bs-toggle="tab">
                                            <i class="fa fa-user"></i>
                                            Account Details
                                        </a>
                                        <a href="#" onclick="return confirm(`logout`)" wire:click="logout">
                                            <i class="fa fa-sign-out"></i>
                                            Logout
                                        </a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade {{ $active_tab=="orders"?"show active":'' }}" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Orders</h5>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Payment</th>
                                                                <th>Recive method</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $item)
                                                                <tr>
                                                                    <td>{{ $item->invoice_id }}</td>
                                                                    <td>{{ Carbon\Carbon::parse($item->invoice_date)->format('M d, Y') }}</td>
                                                                    <td>{{ $item->order_status }}</td>
                                                                    <td>{{ $item->payment_status }}</td>
                                                                    <td>{{ $item->delivery_method }}</td>
                                                                    <td>{{ number_format($item->total_price) }}</td>
                                                                    <td>
                                                                        <a href="/invoice/{{$item->invoice_id}}" class="btn px-1 btn-sm btn-sqr">View</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                    {{ $orders->links() }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade {{ $active_tab=="address"?"show active":'' }}" id="address-edit" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Billing Address</h5>
                                                <div class="account-details-form">
                                                    <form onsubmit="update_profile_address()">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first_name" class="required">First Name</label>
                                                                    <input type="text" wire:model="first_name" name="first_name" id="first_name" placeholder="First Name" />
                                                                    @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last_name" class="required">Last Name</label>
                                                                    <input type="text" wire:model="last_name" name="last_name" id="last_name" placeholder="Last Name" />
                                                                    @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="mobile_number" class="required">Mobile Number</label>
                                                                    <input type="tel" wire:model="mobile_number" name="mobile_number" id="mobile_number" placeholder="Mobile Number" />
                                                                    @error('mobile_number') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="email" class="required">Email</label>
                                                                    <input type="email" wire:model="email" name="email" id="email" placeholder="Email" />
                                                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="single-input-item">
                                                                    <label for="address" class="required">Address</label>
                                                                    <textarea wire:model="address" name="address" id="address" placeholder="address"></textarea>
                                                                    @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="single-input-item">
                                                                    <label for="city" class="required">City</label>
                                                                    <input type="text" wire:model="city" name="city" id="city" placeholder="city" />
                                                                    @error('city') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="single-input-item">
                                                                    <label for="state" class="required">State</label>
                                                                    <input type="text" wire:model="state" name="state" id="state" placeholder="state" />
                                                                    @error('state') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="single-input-item">
                                                                    <label for="zip_code" class="required">zip_code</label>
                                                                    <input type="text" wire:model="zip_code" name="zip_code" id="zip_code" placeholder="zip_code" />
                                                                    @error('zip_code') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="single-input-item">
                                                                    <label for="zone" class="required">zone</label>
                                                                    <select id="zone" wire:model="zone" name="zone" class="form-control">
                                                                        <option value="Dhaka City"> Dhaka City</option>
                                                                        <option value="Khulna City"> Khulna City</option>
                                                                        <option value="Rangpur City"> Rangpur City</option>
                                                                        <option value="Chittagong City">Chittagong City</option>
                                                                        <option value="Gazipur City">Gazipur City</option>
                                                                        <option value="Others">Others</option>
                                                                    </select>
                                                                    @error('zone') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="single-input-item">
                                                                    <label for="country" class="required">country</label>
                                                                    <input type="text" wire:model="country" name="country" id="country" placeholder="country" />
                                                                    @error('country') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="lat" class="required">Lattitude</label>
                                                                    <input type="text" wire:model="lat" name="lat" id="lat" placeholder="Lattitude" />
                                                                    @error('lat') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="lng" class="required">Logntitude</label>
                                                                    <input type="text"  wire:model="lng" name="lng" id="lng" placeholder="Logntitude" />
                                                                    @error('lng') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="single-input-item">
                                                                    <label for="comment" class="required">Other Informations</label>
                                                                    <textarea  wire:model="comment" name="comment" id="comment" placeholder="Other information" ></textarea>
                                                                    @error('comment') <div class="text-danger">{{ $message }}</div> @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <button class="btn btn-sqr">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade {{ $active_tab=="account"?"show active":'' }}" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Account Details</h5>
                                                <div class="account-details-form">
                                                    <form action="#" id="account_details_form" onsubmit="update_profile()">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first_name" class="required">First Name</label>
                                                                    <input type="text" value="{{ auth()->user()->first_name }}" name="first_name" id="first_name" placeholder="First Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last_name" class="required">Last Name</label>
                                                                    <input type="text" value="{{ auth()->user()->last_name }}" name="last_name" id="last_name" placeholder="Last Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="user_name" class="required">User Name</label>
                                                                    <input type="text" name="user_name" value="{{ auth()->user()->user_name }}" id="user_name" placeholder="User Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="mobile_number" class="required">Mobile Number</label>
                                                                    <input type="text" name="mobile_number" value="{{ auth()->user()->mobile_number }}" id="mobile_number" placeholder="Mobile Number" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email Addres</label>
                                                            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" placeholder="Email Address" />
                                                        </div>
                                                        <fieldset>
                                                            <legend>Password change</legend>
                                                            <div class="single-input-item">
                                                                <label for="old_password" class="required">Current Password</label>
                                                                <input type="password" value=" " name="old_password" id="old_password" placeholder="Current Password" />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="password" class="required">New Password</label>
                                                                        <input type="password" name="password" id="password" placeholder="New Password" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="password_confirmation" class="required">Confirm Password</label>
                                                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item">
                                                            <button class="btn btn-sqr">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
