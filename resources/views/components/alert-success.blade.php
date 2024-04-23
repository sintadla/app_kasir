@props(['type' => 'save'])

<div role="alert" {{ $attributes->merge(['class' => 'alert alert-success alert-dismissible fade show']) }}>

    @if ($type == 'delete')
        <strong>Berhasil dihapus!</strong> Data telah berhasil dihapus.
    @elseif ($type == 'edit')
        <strong>Berhasil diupdate!</strong> Data telah berhasil diupdate.
    @else
        <strong>Berhasil disimpan!</strong> Data telah berhasil disimpan.
    @endif

    <button type="button" class="dose" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
