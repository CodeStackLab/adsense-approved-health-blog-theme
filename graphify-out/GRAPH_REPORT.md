# Graph Report - .  (2026-06-08)

## Corpus Check
- cluster-only mode — file stats not available

## Summary
- 46 nodes · 33 edges · 20 communities (19 shown, 1 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- [[_COMMUNITY_Community 2|Community 2]]
- [[_COMMUNITY_Community 5|Community 5]]

## God Nodes (most connected - your core abstractions)
1. `hba_article_card()` - 4 edges
2. `hba_reading_time()` - 3 edges
3. `hba_enqueue_assets()` - 2 edges
4. `hba_get_customizer_css()` - 2 edges
5. `hba_author_initials()` - 2 edges
6. `hba_category_badge_class()` - 2 edges
7. `hba_article_list_item()` - 2 edges

## Surprising Connections (you probably didn't know these)
- None detected - all connections are within the same source files.

## Import Cycles
- None detected.

## Communities (20 total, 1 thin omitted)

### Community 2 - "Community 2"
Cohesion: 0.40
Nodes (5): hba_article_card(), hba_article_list_item(), hba_author_initials(), hba_category_badge_class(), hba_reading_time()

## Knowledge Gaps
- **1 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `hba_article_card()` connect `Community 2` to `Community 0`?**
  _High betweenness centrality (0.002) - this node is a cross-community bridge._
- **Why does `hba_reading_time()` connect `Community 2` to `Community 0`?**
  _High betweenness centrality (0.001) - this node is a cross-community bridge._