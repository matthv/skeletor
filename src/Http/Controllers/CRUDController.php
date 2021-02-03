<?php

namespace Matthv\Skeletor\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Matthv\Skeletor\Traits\Filters;
use Matthv\Skeletor\Traits\HasMany;
use Matthv\Skeletor\Traits\Query;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;

class CRUDController extends Controller
{
    use HasMany, Filters;

    protected $model;

    protected $query;

    protected $entityTitle;

    protected $icon = 'fas fa-skull';

    protected $form;

    protected $formBuilder;

    protected $routePrefix;

    protected $namePrefix;

    protected $routeBranch;

    protected $buttons;

    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
        $this->query = (new $this->model)->select('*');
        $this->dataGrid();
        $this->setButtons();
        $this->routePrefix = config('skeletor.route_prefix');
        $this->namePrefix = Str::slug(config('skeletor.route_prefix')) . '.';
        if (!$this->routeBranch) {
            $this->routeBranch = $this->getResource();
        }
        View::share([
            'model'       => $this->model,
            'entityTitle' => $this->entityTitle,
            'icon'        => $this->icon,
            'routePrefix' => $this->routePrefix,
            'namePrefix'  => $this->namePrefix,
            'routeBranch' => $this->routeBranch,
        ]);
    }

    /**
     * @return array
     */
    public function listFields(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function showFields(): array
    {
        return [];
    }

    public function dataGrid()
    {
    }

    /**
     *
     * @return array
     */
    public function setButtons(): array
    {
        return $this->buttons = [
            'save_and_edit'   => [
                'icons' => ['fa-save'],
                'label' => __('skeletor::skeletor.buttons.save'),
            ],
            'save_and_list'   => [
                'icons' => ['fa-save', 'fa-list'],
                'label' => __('skeletor::skeletor.buttons.save_and_list'),
            ],
            'save_and_create' => [
                'icons' => ['fa-plus-circle'],
                'label' => __('skeletor::skeletor.buttons.save_and_create'),
            ],
        ];
    }

    /**
     * @return Response
     */
    public function index()
    {
        $entities = $this->query->paginate(20)->appends(request()->all());
        $listFields = $this->listFields();
        $filters = $this->getFilters();
        return view('skeletor::CRUD.index', compact('entities', 'listFields', 'filters'));
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $entity = $this->model::find($id);
        $showFields = $this->showFields();
        return view('skeletor::CRUD.show', compact('entity', 'showFields'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $form = $this->getForm();
        $buttons = $this->buttons;
        return view('skeletor::CRUD.create', compact('form', 'buttons'));
    }

    /**
     * @return RedirectResponse|Redirector
     * @throws \ReflectionException
     */
    public function store()
    {
        $entity = new $this->model;
        $form = $this->getForm();
        $form->redirectIfNotValid();
        $entity->fill($form->getFieldValues())->save();

        request()->session()->flash('success', $this->entityTitle . ' créé(e)');
        return redirect($this->saveAndRedirect($entity->id));
    }

    /**
     * @param $id
     *
     * @return Factory|xView
     */
    public function edit($id)
    {
        $form = $this->getForm($id);
        $buttons = $this->buttons;
        return view('skeletor::CRUD.edit', compact('form', 'buttons'));
    }

    /**
     * @param $id
     *
     * @return RedirectResponse
     * @throws \ReflectionException
     */
    public function update($id)
    {
        $entity = $this->model::find($id);
        $form = $this->getForm($id);
        $form->redirectIfNotValid();
        $entity->fill($form->getFieldValues())->save();

        request()->session()->flash('success', $this->entityTitle . ' mis à jour');
        return redirect($this->saveAndRedirect($entity->id));
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function delete($id)
    {
        $entity = $this->model::findOrFail($id);
        return view('skeletor::CRUD.delete', compact('entity'));
    }

    /**
     * @param $id
     *
     * @return RedirectResponse
     * @throws \ReflectionException
     */
    public function destroy($id)
    {
        $this->model::find($id)->delete();
        return redirect()->action('\\' . (new \ReflectionClass($this))->getName() . '@index')->with('success', $this->entityTitle . ' supprimé(e)');
    }

    /**
     * @param null $id
     *
     * @return mixed
     */
    public function getForm($id = null)
    {
        $entity = $this->model::find($id) ?: new $this->model;
        return $this->formBuilder->create($this->form, [
            'model'  => $entity,
            'method' => $id ? 'PUT' : 'POST',
            'url'    => $id ? route($this->routePrefix . '.' . $this->routeBranch . '.update', $id) : route($this->routePrefix . '.' . $this->routeBranch . '.store'),
        ]);
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getResource(): string
    {
        return strtolower(Str::plural((new \ReflectionClass($this->model))->getShortName()));
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public function saveAndRedirect(int $id): string
    {
        if (\Request::has('save_and_edit')) {
            $url = $this->routePrefix . '/' . $this->routeBranch . '/' . $id . '/edit';
        } elseif (\Request::has('save_and_create')) {
            $url = $this->routePrefix . '/' . $this->routeBranch . '/create';
        } else {
            $url = $this->routePrefix . '/' . $this->routeBranch;
        }
        return $url;
    }

}
