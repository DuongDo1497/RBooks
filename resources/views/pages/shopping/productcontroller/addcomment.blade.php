<div class="modal fade" id="modalComment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-4">
                    <span class="icon">
                        <i class="fa-solid fa-paper-plane"></i>
                    </span>
                    
                    <span class="text">
                        Viết nhận xét
                    </span>
                </h5>
            </div>
            <div class="modal-body">
                
                    <div class="books-comment mb-4">
                        <img src="{{ empty($product->images->last()) ? asset(RBOOKS_NO_IMAGE_URL) : RBOOKS_IMAGE_URL . $product->images->last()->path }}" class="img-fluid">
                        <span class="books-name">
                            {{$product->name}}
                        </span>
                    </div>

                    <form action="{{ route('product-comment') }}" method="post" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <input type="text" hidden="true" name="id" value="{{ $product->id }}">
                        <!-- <div class="form-group">
                            <label>Đánh giá:</label>
                            <select name="rate" class="custom-select">
                                <option value="5">Rất hài lòng (5 SAO)</option>
                                <option value="4">Hài lòng (4 SAO)</option>
                                <option value="3">Bình thường (3 SAO)</option>
                                <option value="2">Không hài lòng (2 SAO)</option>
                                <option value="1">Rất không hài lòng (1 SAO)</option>
                            </select>
                        </div> -->
                        

                        {{-- @if(empty(count($banrate)))
                        <div class="rate-start mb-4">
                            <input type="hidden" class="rate-value" name="rate" value="">
                            <p class="text">Đánh giá của bạn về sản phẩm này:</p>
                            <div class="rate-start-wrap">
                                <a href="#" class="icon" data-value="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                                <a href="#" class="icon" data-value="2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                                <a href="#" class="icon" data-value="3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                                <a href="#" class="icon" data-value="4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                                <a href="#" class="icon" data-value="5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                            </div>
                        </div>
                        @else 
                        <div>
                            <p>
                                Bạn đã đánh giá sản phẩm này!!!!
                            </p>
                        </div>
                        @endif --}}

                        <div class="rate-start mb-4">
                            <input type="hidden" class="rate-value" name="rate" value="">
                            <p class="text">Đánh giá của bạn về sản phẩm này:</p>
                            <div class="rate-start-wrap">
                                <a href="#" class="icon" data-value="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                                <a href="#" class="icon" data-value="2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                                <a href="#" class="icon" data-value="3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                                <a href="#" class="icon" data-value="4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                                <a href="#" class="icon" data-value="5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#f4f4f4" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/></svg>
                                </a>
                            </div>
                        </div>
                                                

                        <div class="form-group form-comment mb-4">
                            <label class="mb-3">Viết nhận xét của bạn vào bên dưới: </label>
                            <textarea name="content" class="form-control" cols="100" rows="5" placeholder="Đánh giá/ Nhận xét"></textarea>
                        </div>

                        <div class="review-img">
                            <img src="" alt="" srcset="">
                        </div>

                        <div class="rate-control">
                            <div class="input-file">
                                <input type="file" name="file-img[]" id="file-img" multiple/>
                                <label for="file-img" class="input-label">
                                    <i class="fa-solid fa-camera"></i>
                                    Thêm hình ảnh
                                </label>
                            </div>
                            <button class="btn btn-primary btn-send" type="submit">Gửi</button>
                        </div>
                    </form>
              
       
            </div>
        </div>
    </div>
</div>