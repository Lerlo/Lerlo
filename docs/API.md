# API 接口文档

本项目提供两种文档形式：

1. **OpenAPI 3.0 规范文件**：`docs/openapi.yaml`
2. **快速调试说明（本文）**：便于直接使用 curl 联调

> 认证方式：`Authorization: Bearer <sanctum_token>`

> 权限要求：
> - 列表/详情：`projects.view`
> - 创建：`projects.create`
> - 更新：`projects.update`
> - 删除：`projects.delete`

## 1. 获取项目列表

```bash
curl -X GET 'http://localhost:8000/api/projects?stage=design&per_page=20' \
  -H 'Authorization: Bearer <token>'
```

可选 query 参数：
- `stage`
- `overall_status`
- `project_manager_id`
- `keyword`
- `per_page`（1~100）

---

## 2. 获取项目详情

```bash
curl -X GET 'http://localhost:8000/api/projects/1' \
  -H 'Authorization: Bearer <token>'
```

---

## 3. 创建项目（自动复制腾讯文档模板）

```bash
curl -X POST 'http://localhost:8000/api/projects' \
  -H 'Authorization: Bearer <token>' \
  -H 'Content-Type: application/json' \
  -d '{
    "name": "CRM 重构",
    "description": "企业 CRM 改版",
    "stage": "initiation",
    "design_status": "pending",
    "frontend_status": "pending",
    "backend_status": "pending",
    "overall_status": "in_progress",
    "design_due_at": "2026-03-10 18:00:00",
    "frontend_due_at": "2026-03-20 18:00:00",
    "backend_due_at": "2026-03-25 18:00:00",
    "project_manager_id": 1,
    "designer_id": 2,
    "frontend_developer_id": 3,
    "backend_developer_id": 4,
    "tencent_template_id": "3000000000000000001"
  }'
```

---

## 4. 更新项目

### 4.1 普通更新

```bash
curl -X PATCH 'http://localhost:8000/api/projects/1' \
  -H 'Authorization: Bearer <token>' \
  -H 'Content-Type: application/json' \
  -d '{
    "stage": "testing",
    "overall_status": "in_progress"
  }'
```

### 4.2 更新时同步已复制测试文档内容

```bash
curl -X PATCH 'http://localhost:8000/api/projects/1' \
  -H 'Authorization: Bearer <token>' \
  -H 'Content-Type: application/json' \
  -d '{
    "test_doc_content": "测试记录：提测版本 v1.2.0，核心流程通过。"
  }'
```

---

## 5. 删除项目

```bash
curl -X DELETE 'http://localhost:8000/api/projects/1' \
  -H 'Authorization: Bearer <token>'
```
