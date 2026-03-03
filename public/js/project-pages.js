(function () {
    function headers() {
        const base = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
        if (window.projectApp.token) base.Authorization = `Bearer ${window.projectApp.token}`;
        return base;
    }

    async function api(path = '', options = {}) {
        const res = await fetch(`${window.projectApp.apiBase}${path}`, {
            ...options,
            headers: { ...headers(), ...(options.headers || {}) },
        });

        const data = await res.json().catch(() => ({}));
        if (!res.ok) {
            throw new Error(data.message || '请求失败');
        }
        return data;
    }

    function objectFromForm(form) {
        const data = {};
        new FormData(form).forEach((value, key) => {
            if (value === '') return;
            data[key] = value;
        });
        return data;
    }

    window.renderProjectListPage = function ({ canUpdate = false } = {}) {
        const body = document.getElementById('projectTableBody');
        const msg = document.getElementById('listMessage');

        async function load() {
            try {
                const params = new URLSearchParams();
                ['keyword', 'stage', 'overall_status'].forEach((id) => {
                    const val = document.getElementById(id).value;
                    if (val) params.set(id, val);
                });
                const data = await api(`?${params.toString()}`);
                body.innerHTML = (data.data || []).map((p) => {
                    const actions = [`<a href="/projects/${p.id}">详情</a>`];
                    if (canUpdate) actions.push(`<a href="/projects/${p.id}/edit">编辑</a>`);

                    return `
                    <tr>
                        <td>${p.id}</td>
                        <td>${p.name}</td>
                        <td>${p.stage}</td>
                        <td>${p.overall_status}</td>
                        <td>${p.project_manager_id}</td>
                        <td>${actions.join(' | ')}</td>
                    </tr>`;
                }).join('');
                msg.textContent = `共 ${data.total ?? 0} 条`;
            } catch (e) {
                msg.textContent = e.message;
            }
        }

        document.getElementById('searchBtn').addEventListener('click', load);
        load();
    };

    window.renderProjectCreatePage = function () {
        const form = document.getElementById('projectCreateForm');
        const msg = document.getElementById('createMessage');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const data = objectFromForm(form);
                const created = await api('', { method: 'POST', body: JSON.stringify(data) });
                msg.textContent = `创建成功，项目ID: ${created.id}`;
                form.reset();
            } catch (err) {
                msg.textContent = err.message;
            }
        });
    };

    window.renderProjectShowPage = async function (id) {
        const detail = document.getElementById('projectDetail');
        try {
            const data = await api(`/${id}`);
            detail.textContent = JSON.stringify(data, null, 2);
        } catch (e) {
            detail.textContent = e.message;
        }
    };

    window.renderProjectEditPage = function (id, { canDelete = false } = {}) {
        const form = document.getElementById('projectEditForm');
        const msg = document.getElementById('editMessage');
        const deleteBtn = document.getElementById('deleteBtn');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const payload = objectFromForm(form);
                await api(`/${id}`, { method: 'PATCH', body: JSON.stringify(payload) });
                msg.textContent = '更新成功';
            } catch (err) {
                msg.textContent = err.message;
            }
        });

        if (deleteBtn && canDelete) {
            deleteBtn.addEventListener('click', async () => {
                if (!confirm('确认删除该项目？')) return;
                try {
                    await api(`/${id}`, { method: 'DELETE' });
                    window.location.href = '/projects';
                } catch (err) {
                    msg.textContent = err.message;
                }
            });
        }
    };
})();
