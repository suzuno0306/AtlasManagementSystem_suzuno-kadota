<x-sidebar>
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="w-100 m-auto border" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
<div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">予約キャンセル確認</h5>
    </div>
    <div class="modal-body">
    <input type="hidden" name="getData[]" id="deleteDate" form="deleteParts">
    <input type="hidden" name="getPart[]" id="deletePart" form="deleteParts">
        <p>予約日：<span id="cancelDate"></span></p>
        <p>予約時間（場所・部数）：<span id="cancelPart"></span></p>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
    <button type="submit" class="btn btn-danger" form="deleteParts">予約をキャンセルする</button>
</div>
</div>
</div>
</x-sidebar>
