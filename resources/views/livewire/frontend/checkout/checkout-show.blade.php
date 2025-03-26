<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <div class="underline"></div>

            @if ($this->totalProductAmount != 0)
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="shadow-lg rounded bg-white p-3">
                        <h5 style="color: {{ $appSetting->primary }}">
                            Item Total Amount :
                            @php
                                $totalAmount  =    $this->totalProductAmount+$this->discountAmount
                            @endphp
                            
                            <span class="float-end text-danger">₹{{ number_format($totalAmount, 2) }}</span>
                        </h5>
                        <hr>
                        <small>* Items will be delivered in 3 - 5 days.</small>
                        <br />
                        <small>* Tax and other charges are included?</small>
                    </div>
                </div>

                <!-- Coupon Code Section -->
                <div class="col-md-12 mb-4">
                    <div class="shadow-lg rounded bg-white p-3">
                        <h5 style="color: {{ $appSetting->primary }}">Apply Coupon</h5>
                        <hr>
                        <div class="input-group">
                            <input type="text" wire:model.defer="couponCode" class="form-control" placeholder="Enter Coupon Code 𝙉𝝚5Ƭ5Λ𝗩𝙀" />
                            <button type="button" wire:click="applyCoupon" class="btn text-white" style="background-color: {{ $appSetting->button }}">Apply</button>
                        </div>
                        @if ($this->discountAmount > 0)
                        <div class="mt-2 text-success">
                            Coupon applied! You saved ₹{{ number_format($this->discountAmount, 2) }}
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Final Amount After Coupon -->
                <div class="col-md-12 mb-4">
                    <div class="shadow-lg rounded bg-white p-2">
                        <h5 style="color: {{ $appSetting->primary }}">
                            Final Payable Amount:
                            <span class="float-end text-success">₹{{ number_format($this->finalAmount, 2) }}</span>
                        </h5>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <div class="shadow-lg rounded bg-white p-3">
                        <h5 style="color: {{ $appSetting->primary }}">
                            Basic Information
                        </h5>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" wire:model.defer="fullname" class="form-control" placeholder="Enter Full Name" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="text" wire:model.defer="phone" class="form-control" placeholder="Enter Phone Number" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email Address</label>
                                <input type="email" wire:model.defer="email" class="form-control" placeholder="Enter Email Address" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pin-code (Zip-code)</label>
                                <input type="text" wire:model.defer="pincode" class="form-control" placeholder="Enter Pin-code" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Full Address</label>
                                <textarea wire:model.defer="address" class="form-control" rows="2"></textarea>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-12 ">
                    <div class="shadow-lg rounded bg-white p-3">
                        <h5 style="color: {{ $appSetting->primary }}">
                            Select Payment Mode:
                        </h5>
                        <hr>
                    <div class="d-md-flex align-items-start">
                        <div class="nav col-md-3 flex-column nav-pills me-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <!-- Cash on Delivery Tab -->
                            <button wire:loading.attr="disabled" class="nav-link active fw-bold p-3 rounded border border-2 border-success" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true" style="background-color: #28a745; color: white;">
                                Cash on Delivery
                            </button>
                            <!-- Online Payment Tab -->
                            <button wire:loading.attr="disabled" class="nav-link fw-bold p-3 rounded border border-2  border-danger mt-2" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false" style="background-color: #e12638; color: white;">
                                Online Payment
                            </button>
                        </div>

                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                            <!-- Cash on Delivery Content -->
                            <div class="tab-pane fade active show p-4  rounded" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                <h5 class="fw-bold text-success">Cash on Delivery Mode</h5>
                                <hr/>
                                <button type="button" wire:click="codOrder" class="btn btn-success d-flex align-items-center gap-2" style="transition: all 0.3s ease;">
                                    <span wire:loading.remove wire:target="codOrder">
                                        <i class="fas fa-shopping-cart"></i> Place Order (Cash on Delivery)
                                    </span>
                                    <span wire:loading wire:target="codOrder">
                                        <i class="fas fa-spinner fa-spin"></i> Placing Order...
                                    </span>
                                </button>
                            </div>

                            <!-- Online Payment Content -->
                            <div class="tab-pane fade p-4 rounded" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                <h5 class="fw-bold text-danger">Online Payment Mode</h5>
                                <hr />
                                <button type="button" wire:loading.attr="disabled" class="btn btn-danger d-flex align-items-center gap-2" style="transition: all 0.3s ease;">
                                    <i class="fas fa-credit-card"></i> Pay Now (Online Payment)
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
            
            @else
            <div class="card card-body shadow text-center p-md-5 mb-5">
                <h5>No items in cart to checkout</h5><br>
                <a href="{{ url('collections')}}" class="btn text-white" style="background-color: {{ $appSetting->button }};">Shop Now</a>
            </div>
            @endif
            <br><br><br><br><br>
        </div>
    </div>
</div>
