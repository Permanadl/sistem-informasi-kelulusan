<?php

namespace App\DataTables;

use App\Models\Jurusan;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class JurusanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                $action = '<button type="button" class="btn btn-label-primary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>';
                $action .= '<ul class="dropdown-menu" style="">';

                $action .= "<li><a class='dropdown-item action' href='" . route('jurusan.edit', $row->id) . "'>Edit</a></li>";
                $action .= "<li><a class='dropdown-item action' href='" . route('jurusan.destroy', $row->id) . "'>Hapus</a></li>";

                return $action .= '</ul>';
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Jurusan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Jurusan $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('jurusan-table')
            ->parameters(['searchDelay' => 1000, 'responsive' => ['details' => ['display' => '$.fn.dataTable.Responsive.display.childRowImmediate']]])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('No')->width(20)->orderable(false)->searchable(false),
            Column::make('nama_jurusan'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Jurusan_' . date('YmdHis');
    }
}
